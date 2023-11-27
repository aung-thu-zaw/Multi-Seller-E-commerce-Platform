<?php

namespace App\Actions\Seller\Products;

use App\Http\Traits\ImageUpload;
use App\Models\Product;

class UpdateProductAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Product $product): void
    {
        $image = isset($data['image']) && !is_string($data['image']) ? $this->updateImage($data['image'], $product->image, 'products') : $product->image;

        $product->update([
             'brand_id' => $data['brand_id'],
             'category_id' => $data['category_id'],
             'store_product_category_id' => $data['store_product_category_id'],
             'seller_id' => auth()->id(),
             'name' => $data['name'],
             'description' => $data['description'],
             'sku' => $data['sku'],
             'qty' => $data['qty'],
             'price' => $data['price'],
             'discount' => $data['discount'],
             'discount_start_date' => $data['discount_start_date'],
             'discount_end_date' => $data['discount_end_date'],
             'status' => $data['status'],
             'image' => $image,
         ]);
    }
}
