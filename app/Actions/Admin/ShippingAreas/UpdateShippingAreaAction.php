<?php

namespace App\Actions\Admin\ShippingAreas;

use App\Models\ShippingArea;

class UpdateShippingAreaAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, ShippingArea $shippingArea): void
    {
        $shippingArea->update([
            'region_id' => $data['region_id'],
            'city_id' => $data['city_id'],
            'township_id' => $data['township_id'],
            'name' => $data['name'],
        ]);
    }
}
