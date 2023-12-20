<?php

namespace App\Actions\Admin\Collections;

use App\Models\Collection;

class CreateCollectionAction
{
    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        $collection = Collection::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        foreach ($data['products'] as $product) {

            $product->collections()->attach($collection->id);
        }

    }
}
