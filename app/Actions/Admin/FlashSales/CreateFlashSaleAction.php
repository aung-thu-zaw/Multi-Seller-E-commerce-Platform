<?php

namespace App\Actions\Admin\Collections;

use App\Models\FlashSale;

class CreateFlashSaleAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        $flashSale = FlashSale::create([
            'name' => $data['name'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        ]);

        foreach ($data['products'] as $product) {

            $product->flashSales()->attach($flashSale->id);
        }

    }
}
