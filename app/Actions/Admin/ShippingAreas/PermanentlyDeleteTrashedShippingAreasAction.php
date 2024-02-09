<?php

namespace App\Actions\Admin\ShippingAreas;

use App\Models\ShippingArea;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedShippingAreasAction
{
    /**
     * @param  Collection<int,ShippingArea>  $shippingAreas
     */
    public function handle(Collection $shippingAreas): void
    {
        $shippingAreas->each(function ($shippingArea) {

            $shippingArea->forceDelete();
        });
    }
}
