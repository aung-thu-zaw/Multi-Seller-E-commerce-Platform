<?php

namespace App\Actions\Admin\Collections;

use App\Models\Collection as ProductCollection;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedCollectionsAction
{
    /**
    * @param Collection<int,ProductCollection> $productCollections
    */

    public function handle(Collection $productCollections): void
    {
        $productCollections->each(function ($productCollection) {

            $productCollection->forceDelete();

        });
    }
}
