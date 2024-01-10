<?php

namespace App\Actions\Products;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Collection;

class PermanentlyDeleteTrashedProductsAction
{
    /**
     * @param  Collection<int,Product>  $products
     */
    public function handle(Collection $products): void
    {
        $products->each(function ($product) {

            $productImages = ProductImage::where("product_id", $product->id)->get();

            $productImages->each(function ($image) {

                ProductImage::deleteImage($image);

                $image->delete();

            });

            product::deleteImage($product->image);

            $product->forceDelete();
        });
    }
}
