<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function applyCoupon(Request $request): RedirectResponse
    {
        $coupon = Coupon::where('code', $request->code)
            ->where('expiry_date', '>=', now())
            ->where('status', 'active')
            ->first();

        if (! $coupon) {
            return back()->with('error', 'Coupon code is invalid.');
        }

        $isUsed = auth()
            ->user()
            ->coupons()
            ->wherePivot('coupon_id', $coupon->id)
            ->whereNotNull('used_at')
            ->exists();

        if ($isUsed) {
            return back()->with('error', "You've already used this coupon.");
        }

        $usedCount = $coupon
            ->users()
            ->wherePivotNotNull('used_at')
            ->count();

        if ($usedCount >= $coupon->usage_limit) {
            return back()->with('error', "You're late. The coupon code is limited.");
        }

        if ($coupon->min_spend && $request->total_amount < $coupon->min_spend) {
            return back()->with('error', 'Coupon code is not valid for this amount.');
        }

        auth()->user()->coupons()->attach($coupon->id, ['used_at' => now()]);

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
        ]);

        return back()->with('success', 'Coupon code is applied.');
    }

    public function removeCoupon(string $couponCode): RedirectResponse
    {
        $coupon = Coupon::where('code', $couponCode)->first();

        auth()->user()->coupons()->detach($coupon->id);

        session()->forget('coupon');

        return back()->with('success', 'Coupon code is removed');
    }
}
