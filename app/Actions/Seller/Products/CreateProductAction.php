<?php

namespace App\Actions\Seller\Products;

use App\Http\Traits\ImageUpload;
use App\Models\Product;

class CreateProductAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
    {
        $image = isset($data['image']) ? $this->createImage($data['image'], 'products') : null;

        Product::create([
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id'],
            'store_product_category_id' => $data['store_product_category_id'],
            'seller_id' => $data['seller_id'],
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
