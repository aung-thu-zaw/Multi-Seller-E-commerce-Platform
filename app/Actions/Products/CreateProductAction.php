<?php

namespace App\Actions\Products;

use App\Http\Traits\ImageUpload;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateProductAction
{
    use ImageUpload;

    /**
     * @param  array<mixed>  $data
     */
    public function handle(array $data): void
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

        DB::transaction(function () use ($data, $attributesByName) {
            $image = isset($data["image"]) ? $this->createImage($data["image"], 'products') : null;

            $product = Product::create([
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
                'status' => 'draft',
            ]);

            foreach ($data["images"] as $image) {
                $originalName = $image->getClientOriginalName();

                $fileName = time().'-'.$originalName;

                $image->storeAs('products', $fileName);

                ProductImage::create(['product_id' => $product->id, 'image' => $fileName]);
            }

            if (isset($data["variants"]) && !empty($data["variants"])) {
                foreach ($data["variants"] as $sku) {
                    $skuCode = str($product->name);
                    $skuOptions = [];

                    foreach ($sku['attributes'] as $name => $value) {
                        $skuCode .= ' '.$value.' '.$name;
                        if (! array_key_exists($name, $attributesByName)) {
                            // $this->command->error('Attribute '.$name.' not found');

                            return;
                        }
                        $attributeOption = AttributeOption::where('attribute_id', $attributesByName[$name])
                            ->where('value', $value)
                            ->value('id');
                        if (! $attributeOption) {
                            // $this->command->error('Attribute Value '.$name.' => '.$value.' not found');

                            return;
                        }
                        $skuOptions[] = $attributeOption;
                    }
                    $sku = $product->skus()->create([
                        'code' => str()->slug($skuCode),
                        'price' => $sku['price'],
                        'offer_price' => $sku['offer_price'],
                        'qty' => $sku['qty'],
                    ]);

                    $sku->attributeOptions()->attach($skuOptions);
                }
            }
        });

    }
}
