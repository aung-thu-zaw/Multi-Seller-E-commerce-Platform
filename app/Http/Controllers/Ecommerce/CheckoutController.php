<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
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

    public function handleShippingMethod($shippingMethodId): RedirectResponse
    {
        $user = auth()->user();
        $cartItems = $user->cart->cartItems;

        $cartItems->each(function ($item) use ($shippingMethodId) {
            $item->update(["shipping_method_id" => $shippingMethodId]);
        });

        return back();
    }

    private function getShippingArea($address): ShippingArea
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
            $totalCartItemAmount = $this->applyCouponDiscount($totalCartItemAmount, $coupon);
        }

        return $totalCartItemAmount;
    }

    private function applyCouponDiscount(int $total, array $coupon): int
    {
        if ($coupon['type'] === 'fixed') {
            $total -= $coupon['value'];
        } elseif ($coupon['type'] === 'percentage') {
            $total *= (1 - $coupon['value'] / 100);
        }

        return $total;
    }

    private function getShippingRate(ShippingArea $shippingArea, object $cartItems, int $totalCartItemAmount): ShippingRate
    {
        return ShippingRate::select("rate")
            ->where("shipping_area_id", $shippingArea->id)
            ->where("shipping_method_id", $cartItems[0]->shipping_method_id)
            ->where("min_order_total", '<=', $totalCartItemAmount)
            ->first();
    }
}
