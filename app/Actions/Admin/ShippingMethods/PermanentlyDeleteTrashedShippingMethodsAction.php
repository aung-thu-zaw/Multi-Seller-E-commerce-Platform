<?php

namespace App\Actions\Admin\ShippingMethods;

use App\Models\ShippingMethod;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedShippingMethodsAction
{
    /**
     * @param  Collection<int,ShippingMethod>  $shippingMethods
     */
    public function handle(Collection $shippingMethods): void
    {
        $shippingMethods->each(function ($shippingMethod) {

            $shippingMethod->forceDelete();
        });
    }
}
