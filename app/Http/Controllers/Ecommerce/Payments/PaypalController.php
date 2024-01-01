<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use App\Http\Traits\CheckoutPayment;
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
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    use CheckoutPayment;

    public function payWithPaypal(): RedirectResponse
    {
        $coupon = session('coupon') ?? null;
        $cartItems = auth()->user()->cart->cartItems;
        $address = Address::where('user_id', auth()->id())->where('is_default_delivery', 1)->first();
        $shippingArea = $this->getShippingArea($address);
        $totalCartItemAmount = $this->calculateTotalCartItemAmount($cartItems, $coupon);
        $shippingRate = $this->getShippingRate($shippingArea, $cartItems, $totalCartItemAmount);

        try {
            $provider = new PayPalClient();

            $provider->setApiCredentials(config('paypal'));

            $provider->getAccessToken();

            $response = $provider->createOrder([
                'intent' => 'CAPTURE',
                'application_context' => [
                    'return_url' => route('payments.paypal.success'),
                    'cancel_url' => route('payments.paypal.cancel'),
                ],
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' =>  $totalCartItemAmount + $shippingRate->rate,
                        ],
                    ],
                ],
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $links) {
                    if ($links['rel'] === 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
            } else {

                return redirect()->route('payments.paypal.cancel');
            }
        } catch (Exception $e) {
            Log::error('PayPal API Error: '.$e->getMessage());

            return back()->with("error", "Something went wrong!");
        }
    }

    public function paypalSuccess(Request $request): RedirectResponse
    {
        $coupon = session('coupon') ?? null;
        $cartItems = auth()->user()->cart->cartItems;
        $shippingMethod = ShippingMethod::find($cartItems[0]->shipping_method_id);
        $address = Address::where('user_id', auth()->id())->where('is_default_delivery', 1)->first();
        $shippingArea = $this->getShippingArea($address);
        $totalCartItemAmount = $this->calculateTotalCartItemAmount($cartItems, $coupon);
        $shippingRate = $this->getShippingRate($shippingArea, $cartItems, $totalCartItemAmount);

        $productsByStore = [];

        try {

            $provider = new PayPalClient(config('paypal'));

            $provider->getAccessToken();

            $response = $provider->capturePaymentOrder($request->token);

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {

                DB::transaction(function () use ($totalCartItemAmount, $shippingRate, $cartItems, $shippingMethod, $address, &$productsByStore) {
                    $order = Order::create([
                        'user_id' => auth()->id(),
                        'invoice_no' => 'E-COMMERCE' . mt_rand(100000000, 999999999),
                        'tracking_no' => '#' . uniqid(),
                        'product_qty' => $cartItems->sum('qty'),
                        'payment_method' => 'paypal',
                        'payment_status' => 'paid',
                        'total_amount' => $totalCartItemAmount + $shippingRate->rate,
                        'address' => $address->address,
                        'shipping_method' => $shippingMethod->name,
                        'shipping_fee' => $shippingRate->rate,
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
                        'payment_method' => 'paypal',
                        'amount' => $totalCartItemAmount + $shippingRate->rate,
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
            } else {

                return to_route('payments.paypal.cancel');
            }

        } catch (Exception $e) {
            Log::error('PayPal API Error: ' . $e->getMessage());

            return back()->with("error", "Something went wrong!");
        }
    }

    public function paypalCancel(Request $request): RedirectResponse
    {
        return to_route('payments')->with('error', 'Something went wrong!');
    }
}
