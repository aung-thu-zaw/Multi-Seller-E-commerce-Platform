<?php

namespace App\Actions\Admin\ShippingAreas;

use App\Models\ShippingArea;

class CreateShippingAreaAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        ShippingArea::create([
            'region_id' => $data['region_id'],
            'city_id' => $data['city_id'],
            'township_id' => $data['township_id'],
            'name' => $data['name'],
        ]);
    }
}
