<?php

namespace App\Actions\Admin\ShippingRates;

use App\Models\ShippingRate;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedShippingRatesAction
{
    /**
     * @param  Collection<int,ShippingRate>  $shippingRates
     */
    public function handle(Collection $shippingRates): void
    {
        $shippingRates->each(function ($shippingRate) {

            $shippingRate->forceDelete();
        });
    }
}
