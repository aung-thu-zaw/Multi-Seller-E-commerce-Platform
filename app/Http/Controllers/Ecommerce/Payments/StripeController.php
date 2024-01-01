<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlacedMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingArea;
use App\Models\ShippingRate;
use App\Models\User;
use App\Notifications\OrderPlacedNotification;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Inertia\Response;
use Inertia\ResponseFactory;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function payWithStripe(Request $request): RedirectResponse
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));





        $paymentIntent = PaymentIntent::create([
            'amount' => $request->total_price * 100,
            'currency' => 'usd',
            'description' => 'product purchase!',
            'payment_method' => $request->payment_method_id,
            'confirm' => true,
            'metadata' => [
                'order_id' => "#".uniqid(),
            ]
            ]);

        $user = auth()->user();

        $charge = Charge::retrieve($paymentIntent->latest_charge);
        $balanceTransactionId = $charge->balance_transaction;

        // $order = Order::create([
        //     "user_id" => $user->id,
        //     "delivery_information_id" => $user->deliveryInformation->id,
        //     'payment_id' => $paymentIntent->id,
        //     'payment_type' => $paymentIntent->payment_method_types[0],
        //     'payment_method' => $paymentIntent->payment_method,
        //     'transaction_id' => $balanceTransactionId,
        //     'currency' => $paymentIntent->currency,
        //     'total_amount' => $request->total_price,
        //     'order_no' => $paymentIntent->metadata['order_id'],
        //     'invoice_no' => 'GLOBAL E-COMMERCE'.mt_rand(100000000, 999999999),
        //     'order_date' => Carbon::now()->format("Y-m-d"),
        //     'order_status' => "pending",
        // ]);

        // foreach ($request->cart_items as $item) {
        //     OrderItem::create([
        //         "order_id" => $order->id,
        //         "product_id" => $item["product"]["id"],
        //         "shop_id" => $item["product"]["shop"]["id"],
        //         "color" => $item["color"] ?? null,
        //         "size" => $item["size"] ?? null,
        //         "qty" => $item["qty"],
        //         "price" => $item["total_price"],
        //     ]);
        // }

        // $placedOrder = Order::with(["deliveryInformation","orderItems.product.shop"])->where("id", $order->id)->first();


        // $admins = User::where("role", "admin")->get();
        // Notification::send($admins, new OrderPlacedNotification($order));



        // Mail::to($placedOrder->deliveryInformation->email)->send(new OrderPlacedMail($placedOrder));

        if (session("coupon")) {
            session()->forget("coupon");
        }

        $cart = auth()->user()->cart;
        $cartItems = $cart->cartItems;

        $cartItems->each(function ($item) {
            $item->destroy($item->id);
        });

        return to_route("home")->with("success", "Your place order is successfully");
    }

    private function getShippingArea($address)
    {
        return ShippingArea::where([
            "region_id" => $address->region_id,
            "city_id" => $address->city_id,
            "township_id" => $address->township_id,
        ])->first();
    }

    private function calculateTotalCartItemAmount($cartItems, $coupon)
    {
        $totalCartItemAmount = $cartItems->sum('total_price');

        if ($coupon) {
            if ($coupon['type'] === 'fixed') {
                $totalCartItemAmount -= $coupon['value'];
            } elseif ($coupon['type'] === 'percentage') {
                $totalCartItemAmount *= (1 - $coupon['value'] / 100);
            }
        }

        return $totalCartItemAmount;
    }

    private function getShippingRate($shippingArea, $request, $totalCartItemAmount)
    {
        return ShippingRate::select("rate")
            ->where("shipping_area_id", $shippingArea->id)
            ->where("shipping_method_id", $request->shipping_method_id ?? 1)
            ->where("min_order_total", '<=', $totalCartItemAmount)
            ->first();
    }
}
