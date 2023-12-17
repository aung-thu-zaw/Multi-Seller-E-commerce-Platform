<?php

namespace App\Actions\Admin\Brands;

use App\Http\Traits\ImageUpload;
use App\Models\FlashSale;

class UpdateFlashSaleAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, FlashSale $flashSale): void
    {
        $flashSale->update([
            'name' => $data['name'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        ]);

        foreach($data['products'] as $product) {

            $product->flashSales()->attach($flashSale->id);
        }
    }
}
