<?php

namespace App\Actions\Seller\Products;

use App\Http\Traits\ImageUpload;
use App\Models\Product;
use App\Services\SkuGeneratorService;

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
            'store_id' => $data['store_id'],
            'name' => $data['name'],
            'qty' => $data['qty'],
            'price' => $data['price'],
            'offer_price' => $data['offer_price'],
            'offer_price_start_date' => $data['offer_price_start_date'],
            'offer_price_end_date' => $data['offer_price_end_date'],
            'description' => $data['description'],
            'warranty_type' => $data['warranty_type'] ?? 'no warranty',
            'warranty_policy' => $data['warranty_policy'],
            'warranty_period' => $data['warranty_period'],
            'return_day' => $data['return_day'],
            'return_policy' => $data['return_policy'],
            'status' => $data['status'],
            'code' => $data['code'],
            'image' => $image,
        ]);
    }
}
