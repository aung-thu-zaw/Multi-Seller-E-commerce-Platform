<?php

namespace App\Actions\Products;

use App\Models\Product;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedProductsAction
{
    /**
     * @param  Collection<int,Product>  $products
     */
    public function handle(Collection $products): void
    {
        $products->each(function ($product) {

            product::deleteImage($product->image);

            $product->forceDelete();
        });
    }
}
