<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use App\Http\Traits\CheckoutPayment;
use App\Models\Address;
use App\Models\ShippingArea;
use App\Models\ShippingMethod;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class PaymentController extends Controller
{
    use CheckoutPayment;

    public function __invoke(): Response|ResponseFactory
    {
        $user = auth()->user();
        $coupon = session("coupon") ?? null;
        $address = Address::where("user_id", $user->id)->where("is_default_delivery", 1)->first();
        $shippingArea = $this->getShippingArea($address);
        $shippingMethods = ShippingMethod::select("id", "name")->get();
        $cartItems = $user->cart->cartItems;
        $totalCartItemAmount = $this->calculateTotalCartItemAmount($cartItems, $coupon);
        $shippingRate = $this->getShippingRate($shippingArea, $cartItems, $totalCartItemAmount);
        $stripeKey = env('STRIPE_KEY');

        return inertia("E-commerce/Payments/Index", compact("coupon", "address", "shippingMethods", "shippingRate", 'stripeKey'));
    }
}
