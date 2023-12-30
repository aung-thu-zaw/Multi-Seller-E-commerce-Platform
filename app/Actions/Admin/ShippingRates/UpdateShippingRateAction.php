<?php

namespace App\Actions\Admin\ShippingRates;

use App\Http\Traits\ImageUpload;
use App\Models\Brand;
use App\Models\ShippingRate;

class UpdateShippingRateAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, ShippingRate $shippingRate): void
    {
        $shippingRate->update([
            'shipping_area_id' => $data['shipping_area_id'],
            'shipping_method_id' => $data['shipping_method_id'],
            'min_order_total' => $data['min_order_total'],
            'max_order_total' => $data['max_order_total'],
            'rate' => $data['rate'],
        ]);
    }
}
