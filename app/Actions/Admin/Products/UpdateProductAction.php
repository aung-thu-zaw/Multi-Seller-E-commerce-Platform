<?php

namespace App\Actions\Admin\Products;

use App\Http\Traits\ImageUpload;
use App\Models\Product;
use App\Services\SkuGeneratorService;

class UpdateProductAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Product $product): void
    {
        $fieldsAffectingSku = ['name' => $product->name, 'category_id' => $product->category_id];

        $fieldsChanged = array_filter($fieldsAffectingSku, function ($value, $key) use ($data) {
            return isset($data[$key]) && $data[$key] !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        $image = isset($data['image']) && ! is_string($data['image']) ? $this->updateImage($data['image'], $product->image, 'products') : $product->image;

        $product->update([
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
            'warranty_type' => $data['warranty_type'],
            'warranty_policy' => $data['warranty_policy'],
            'warranty_period' => $data['warranty_period'],
            'return_day' => $data['return_day'],
            'return_policy' => $data['return_policy'],
            'status' => $data['status'],
            'sku' => ! empty($fieldsChanged) ? SkuGeneratorService::generateProductSku($data['name'], $data['category_id']) : $product->sku,
            'image' => $image,
        ]);
    }
}
