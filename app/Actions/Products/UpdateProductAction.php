<?php

namespace App\Actions\Products;

use App\Http\Traits\ImageUpload;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Sku;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateProductAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data, Product $product): void
    {
        if (isset($data["attribute_options"])) {
            foreach ($data["attribute_options"] as $attributeOption) {
                $attributeName = $attributeOption['attribute'];
                $options = $attributeOption['options'];

                $attribute = Attribute::firstOrCreate(['name' => $attributeName]);

                foreach ($options as $option) {
                    AttributeOption::firstOrCreate([
                        'attribute_id' => $attribute->id,
                        'value' => $option,
                    ]);
                }
            }
        }

        $attributesByName = Attribute::pluck('id', 'name')->toArray();

        DB::transaction(function () use ($data, $product, $attributesByName) {

            $image = isset($data['image']) && ! is_string($data['image']) ? $this->updateImage($data['image'], $product->image, 'products') : $product->image;

            $product->update([
                'brand_id' => $data["brand_id"],
                'category_id' => $data["category_id"],
                'store_id' => isset($data["store_id"]) ? $data["store_id"] : Store::getStoreId(),
                'name' => $data["name"],
                'description' => $data["description"],
                'code' => str()->slug($data["name"]) . '-' . Str::random(4),
                'price' => $data["price"],
                'offer_price' => $data["offer_price"] ?? null,
                'offer_price_start_date' => $data["offer_price_start_date"] ?? null,
                'offer_price_end_date' => $data["offer_price_end_date"] ?? null,
                'qty' => $data["qty"] ?? null,
                'image' => $image,
                'warranty_type' => $data["warranty_type"] ?? null,
                'warranty_period' => $data["warranty_period"] ?? null,
                'warranty_policy' => $data["warranty_policy"] ?? null,
                'return_day' => $data["return_day"] ?? null,
                'return_policy' => $data["return_policy"] ?? null,
            ]);

            if(isset($data["images"])) {
                foreach ($data["images"] as $image) {
                    $originalName = $image->getClientOriginalName();

                    $fileName = time().'-'.$originalName;

                    $image->storeAs('products', $fileName);

                    ProductImage::create(['product_id' => $product->id, 'image' => $fileName]);
                }
            }

            if (isset($data["variants"]) && !empty($data["variants"])) {
                foreach ($data["variants"] as $variantData) {
                    $skuOptions = [];

                    foreach ($variantData['attributes'] as $name => $value) {
                        if (!array_key_exists($name, $attributesByName)) {
                            return;
                        }

                        $attributeOption = AttributeOption::where('attribute_id', $attributesByName[$name])
                            ->where('value', $value)
                            ->value('id');

                        if (!$attributeOption) {
                            return;
                        }

                        $skuOptions[] = $attributeOption;
                    }

                    $existingSku = $product->skus()
                        ->whereHas('attributeOptions', function ($query) use ($skuOptions) {
                            $query->whereIn('attribute_option_id', $skuOptions);
                        })
                        ->first();

                    if ($existingSku) {
                        $existingSku->update([
                            'price' => $variantData['price'],
                            'offer_price' => $variantData['offer_price'],
                            'qty' => $variantData['qty'],
                        ]);
                    } else {
                        return back()->with("error", "product variants not found");
                    }
                }
            }
        });

    }
}
