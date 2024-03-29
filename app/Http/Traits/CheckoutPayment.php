<?php

namespace App\Http\Traits;

use App\Models\Address;
use App\Models\ShippingArea;
use App\Models\ShippingRate;
use Illuminate\Http\RedirectResponse;

trait CheckoutPayment
{
    private function getShippingArea(Address $address): ?ShippingArea
    {
        return ShippingArea::where([
             'region_id' => $address->region_id,
             'city_id' => $address->city_id,
             'township_id' => $address->township_id,
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

    private function getShippingRate(?ShippingArea $shippingArea, object $cartItems, int $totalCartItemAmount): ?ShippingRate
    {
        return ShippingRate::select('rate')
            ->where('shipping_area_id', $shippingArea->id)
            ->where('shipping_method_id', $cartItems[0]->shipping_method_id)
            ->where('min_order_total', '<=', $totalCartItemAmount)
            ->first();
    }
}
