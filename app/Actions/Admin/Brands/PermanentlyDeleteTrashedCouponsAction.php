<?php

namespace App\Actions\Admin\Coupons;

use App\Models\Coupon;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedCouponsAction
{
    /**
     * @param  Collection<int,Coupon>  $coupons
     */
    public function handle(Collection $coupons): void
    {
        $coupons->each(function ($coupon) {

            $coupon->forceDelete();
        });
    }
}
