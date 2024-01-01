<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use App\Mail\Admin\NewOrderPlacedEmail;
use App\Mail\Seller\NewOrderPlacedEmail as SellerNewOrderPlacedEmail;
use App\Mail\User\OrderPlacedSuccessfullyEmail;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingMethod;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CashOnDeliveryController extends Controller
{
    public function payWithCash(Request $request): RedirectResponse
    {
        $cartItems = auth()->user()->cart->cartItems;
        $shippingMethod = ShippingMethod::find($cartItems[0]->shipping_method_id);
        $address = Address::where('user_id', auth()->id())
            ->where('is_default_delivery', 1)
            ->first();

        $productsByStore = [];

        try {
            DB::transaction(function () use ($request, $cartItems, $shippingMethod, $address, &$productsByStore) {
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'invoice_no' => 'E-COMMERCE' . mt_rand(100000000, 999999999),
                    'tracking_no' => '#' . uniqid(),
                    'product_qty' => $cartItems->sum('qty'),
                    'payment_method' => 'cash on delivery',
                    'payment_status' => 'pending',
                    'total_amount' => $request->total_amount,
                    'address' => $address->address,
                    'shipping_method' => $shippingMethod->name,
                    'shipping_fee' => $request->shipping_fee,
                    'coupon' => session('coupon') ? session('coupon')['code'] : null,
                    'status' => 'pending',
                ]);

                $cartItems->each(function ($item) use ($order, &$productsByStore) {
                    $orderItem = OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'store_id' => $item->store_id,
                        'qty' => $item->qty,
                        'attributes' => $item->attributes,
                        'unit_price' => $item->unit_price,
                        'total_price' => $item->total_price,
                    ]);

                    $productsByStore[$item->store_id][] = $orderItem;
                });

                Transaction::create([
                    'order_id' => $order->id,
                    'transaction_id' => null,
                    'payment_method' => 'cash on delivery',
                    'amount' => $request->total_amount,
                ]);

                if (session('coupon')) {
                    session()->forget('coupon');
                }

                $cartItems->each(function ($item) {
                    $item->destroy($item->id);
                });

                $placedOrder = Order::with(['user:id,name', 'orderItems.product:id,image,name'])->find($order->id);

                Mail::to($address->email)->queue(new OrderPlacedSuccessfullyEmail($address, $placedOrder));

                $admins = User::where('role', 'admin')
                    ->permission(['orders.edit'])
                    ->get();

                $admins->each(function ($admin) use ($address, $placedOrder) {
                    Mail::to($admin->email)->queue(new NewOrderPlacedEmail($admin, $address, $placedOrder));
                });

                foreach ($productsByStore as $storeId => $orderItems) {
                    $store = Store::with('seller:id,name')->find($storeId);

                    Mail::to($store->contact_email)->queue(new SellerNewOrderPlacedEmail($store, $address, $orderItems));
                }
            });

            return to_route('home')->with('success', 'Your order placed is successfully.');
        } catch (\Exception $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
        }

        return back();
    }
}
