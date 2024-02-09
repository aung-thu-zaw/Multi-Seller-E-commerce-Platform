<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Traits\CheckoutPayment;
use App\Models\Address;
use App\Models\ShippingArea;
use App\Models\ShippingMethod;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class CheckoutController extends Controller
{
    use CheckoutPayment;

    public function index(): Response|ResponseFactory|RedirectResponse
    {
        $user = auth()->user();
        $coupon = session('coupon') ?? null;
        $address = Address::where('user_id', $user->id)->where('is_default_delivery', 1)->first();

        $shippingMethods = ShippingMethod::select('id', 'name')->get();
        $cartItems = $user->cart->cartItems;
        $totalCartItemAmount = $this->calculateTotalCartItemAmount($cartItems, $coupon);

        $shippingRate = null;
        $shippingArea = null;


        if($address) {

            $shippingArea = $this->getShippingArea($address);
        } else {

            return redirect()->route('my-cart.index')->with('error', "Please create a default delivery address before proceeding.");

        }

        if($shippingArea) {
            $shippingRate = $this->getShippingRate($shippingArea, $cartItems, $totalCartItemAmount);
        } else {

            return to_route('my-cart.index')->with('error', "Sorry, we currently do not support shipping to your area. Please contact support for assistance.");
        }

        return inertia('E-commerce/CartAndCheckout/Checkout', compact('coupon', 'address', 'shippingMethods', 'shippingRate'));
    }

    public function handleShippingMethod(int $shippingMethodId): RedirectResponse
    {
        $user = auth()->user();
        $cartItems = $user->cart->cartItems;

        $cartItems->each(function ($item) use ($shippingMethodId) {
            $item->update(['shipping_method_id' => $shippingMethodId]);
        });

        return back();
    }
}
