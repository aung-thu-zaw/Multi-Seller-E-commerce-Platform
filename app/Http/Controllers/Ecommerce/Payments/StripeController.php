<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlacedMail;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingArea;
use App\Models\ShippingMethod;
use App\Models\ShippingRate;
use App\Models\User;
use App\Notifications\OrderPlacedNotification;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Inertia\Response;
use Inertia\ResponseFactory;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function payWithStripe(Request $request): RedirectResponse
    {
        $cartItems = auth()->user()->cart->cartItems;
        $shippingMethod = ShippingMethod::find($cartItems[0]->shipping_method_id);
        $address = Address::where("user_id", auth()->id())->where("is_default_delivery", 1)->first();

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            DB::transaction(function () use ($request, $cartItems, $shippingMethod, $address) {
                $response = PaymentIntent::create([
                    'amount' => $request->total_amount * 100,
                    'currency' => 'usd',
                    'description' => 'product purchase!',
                    'payment_method' => $request->payment_method_id,
                    'confirm' => true,
                    'metadata' => [
                        'order_id' => "#" . uniqid(),
                    ],
                    'return_url' => env('APP_URL'),
                ]);

                if ($response->status === "succeeded") {
                    $order = Order::create([
                        "user_id" => auth()->id(),
                        'invoice_no' => 'E-COMMERCE' . mt_rand(100000000, 999999999),
                        "product_qty" => $cartItems->sum('qty'),
                        "payment_method" => 'card',
                        "payment_status" => 'paid',
                        "total_amount" => $request->total_amount,
                        "address" => $address->address,
                        "shipping_method" => $shippingMethod->name,
                        "coupon" => session("coupon") ?? null,
                        "status" => 'pending',
                    ]);

                    $cartItems->each(function ($item) use ($order) {
                        OrderItem::create([
                            "order_id" => $order->id,
                            "product_id" => $item->product_id,
                            "store_id" => $item->store_id,
                            "qty" => $item->qty,
                            "attributes" => $item->attributes,
                            "unit_price" => $item->unit_price,
                            "total_price" => $item->total_price,
                        ]);
                    });

                    // Other actions such as sending emails, notifications, etc.

                    if (session("coupon")) {
                        session()->forget("coupon");
                    }

                    $cartItems->each(function ($item) {
                        $item->destroy($item->id);
                    });

                    dd("purchased!");

                } else {
                    dd("fail");
                }
            });

        } catch (\Exception $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
        }

        return to_route("home")->with("success", "Your place order is successfully");
    }
}
