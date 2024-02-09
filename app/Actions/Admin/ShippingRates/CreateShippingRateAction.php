<?php

namespace App\Actions\Admin\ShippingRates;

use App\Models\ShippingRate;

class CreateShippingRateAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        ShippingRate::create([
            'shipping_area_id' => $data['shipping_area_id'],
            'shipping_method_id' => $data['shipping_method_id'],
            'min_order_total' => $data['min_order_total'],
            'max_order_total' => $data['max_order_total'],
            'rate' => $data['rate'],
        ]);
    }
}
