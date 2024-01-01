<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Traits\CheckoutPayment;
use App\Models\Address;
use App\Models\ShippingArea;
use App\Models\ShippingMethod;
use App\Models\ShippingRate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class CheckoutController extends Controller
{
    use CheckoutPayment;

    public function index(): Response|ResponseFactory
    {
        $user = auth()->user();
        $coupon = session("coupon") ?? null;
        $address = Address::where("user_id", $user->id)->where("is_default_delivery", 1)->first();
        $shippingArea = $this->getShippingArea($address);
        $shippingMethods = ShippingMethod::select("id", "name")->get();
        $cartItems = $user->cart->cartItems;
        $totalCartItemAmount = $this->calculateTotalCartItemAmount($cartItems, $coupon);
        $shippingRate = $this->getShippingRate($shippingArea, $cartItems, $totalCartItemAmount);

        return inertia("E-commerce/CartAndCheckout/Checkout", compact("coupon", "address", "shippingMethods", "shippingRate"));
    }

    public function handleShippingMethod(int $shippingMethodId): RedirectResponse
    {
        $user = auth()->user();
        $cartItems = $user->cart->cartItems;

        $cartItems->each(function ($item) use ($shippingMethodId) {
            $item->update(["shipping_method_id" => $shippingMethodId]);
        });

        return back();
    }
}
