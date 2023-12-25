<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributesByName = Attribute::pluck('id', 'name')->toArray();

        $products = [
            [
                'name' => 'Samsung Galaxy S21',
                'status' => 'approved',
                'SKUs' => [
                    [
                        'price' => 349,
                        'attributes' => [
                            'color' => 'Red', 'ram' => '2GB', 'storage' => '32GB'
                        ],
                    ],
                    [
                        'price' => 349,
                        'attributes' => [
                            'color' => 'Green', 'ram' => '4GB', 'storage' => '32GB'
                        ],
                    ],
                    [
                        'price' => 349,
                        'attributes' => [
                            'color' => 'Yellow', 'ram' => '8GB', 'storage' => '32GB'
                        ],
                    ],
                    [
                        'price' => 1099,
                        'attributes' => [
                            'color' => 'Blue', 'ram' => '8GB', 'storage' => '512GB'
                        ],
                    ],
                    [
                        'price' => 1499,
                        'attributes' => [
                            'color' => 'Black', 'ram' => '16GB', 'storage' => '1TB'
                        ],
                    ],
                ]
            ],
            [
                'name' => 'iPhone 14 MAX',
                'status' => 'approved',
                'SKUs' => [
                    [
                        'price' => 449,
                        'attributes' => [
                            'color' => 'Red', 'ram' => '2GB', 'storage' => '32GB'
                        ],
                    ],
                    [
                        'price' => 449,
                        'attributes' => [
                            'color' => 'Green', 'ram' => '4GB', 'storage' => '32GB'
                        ],
                    ],
                    [
                        'price' => 449,
                        'attributes' => [
                            'color' => 'Yellow', 'ram' => '8GB', 'storage' => '32GB'
                        ],
                    ],
                    [
                        'price' => 1299,
                        'attributes' => [
                            'color' => 'Blue', 'ram' => '8GB', 'storage' => '512GB'
                        ],
                    ],
                    [
                        'price' => 1999,
                        'attributes' => [
                            'color' => 'Blue', 'ram' => '16GB', 'storage' => '512GB'
                        ],
                    ],
                ]
            ]
        ];

        foreach ($products as $product) {
            DB::transaction(function () use ($product, $attributesByName) {
                $DBProduct = Product::factory()->create([
                    'name' => $product['name'],
                    'slug' => str($product['name'])->slug()
                ]);

                foreach ($product['SKUs'] as $sku) {
                    $skuCode = str($product['name']);
                    $skuOptions = [];
                    foreach ($sku['attributes'] as $name => $value) {
                        $skuCode .= ' ' . $value . ' ' . $name;
                        if (!array_key_exists($name, $attributesByName)) {
                            $this->command->error('Attribute ' . $name . ' not found');
                            return;
                        }
                        $attributeOption = AttributeOption::where('attribute_id', $attributesByName[$name])->where('value', $value)->value('id');
                        if (!$attributeOption) {
                            $this->command->error('Attribute Value ' . $name . ' => ' . $value . ' not found');
                            return;
                        }
                        $skuOptions[] = $attributeOption;
                    }
                    $sku = $DBProduct->skus()->create([
                        'code' => str()->slug($skuCode),
                        'price' => $sku['price']
                    ]);
                    $sku->attributeOptions()->attach($skuOptions);
                }
            });
        }

        // Product::factory(95)->create(['status' => 'approved']);

        Product::factory()->create(["image" => "product-1.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-2.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-3.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-4.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-5.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-6.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-7.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-8.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-9.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-10.jpg",'status' => 'approved']);

        Product::factory()->create(["image" => "product-11.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-12.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-13.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-14.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-15.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-16.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-17.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-18.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-19.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-20.jpg",'status' => 'approved']);

        Product::factory()->create(["image" => "product-21.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-22.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-23.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-24.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-25.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-26.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-27.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-28.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-29.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-30.jpg",'status' => 'approved']);

        Product::factory()->create(["image" => "product-31.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-32.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-33.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-34.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-35.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-36.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-37.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-38.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-39.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-40.jpg",'status' => 'approved']);

        Product::factory()->create(["image" => "product-41.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-42.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-43.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-44.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-45.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-46.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-47.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-48.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-49.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-50.jpg",'status' => 'approved']);

        Product::factory()->create(["image" => "product-51.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-52.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-53.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-54.jpg",'status' => 'approved']);
        Product::factory()->create(["image" => "product-55.jpg",'status' => 'approved']);

        Product::factory(1000)->create();
        // Product::factory(50)->create(['store_id' => 2, 'status' => 'approved']);
    }
}
