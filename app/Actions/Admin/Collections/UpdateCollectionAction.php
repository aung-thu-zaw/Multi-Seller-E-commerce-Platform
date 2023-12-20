<?php

namespace App\Actions\Admin\Brands;

use App\Models\Collection;

class UpdateCollectionAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Collection $collection): void
    {
        $collection->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        foreach ($data['products'] as $product) {

            $product->collections()->attach($collection->id);
        }
    }
}
