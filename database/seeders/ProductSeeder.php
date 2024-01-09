<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create(['image' => 'product-1.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-2.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-3.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-4.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-5.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-6.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-7.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-8.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-9.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-10.jpg', 'status' => 'approved']);

        Product::factory()->create(['image' => 'product-11.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-12.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-13.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-14.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-15.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-16.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-17.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-18.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-19.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-20.jpg', 'status' => 'approved']);

        Product::factory()->create(['image' => 'product-21.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-22.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-23.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-24.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-25.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-26.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-27.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-28.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-29.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-30.jpg', 'status' => 'approved']);

        Product::factory()->create(['image' => 'product-31.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-32.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-33.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-34.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-35.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-36.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-37.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-38.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-39.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-40.jpg', 'status' => 'approved']);

        Product::factory()->create(['image' => 'product-41.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-42.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-43.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-44.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-45.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-46.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-47.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-48.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-49.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-50.jpg', 'status' => 'approved']);

        Product::factory()->create(['image' => 'product-51.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-52.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-53.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-54.jpg', 'status' => 'approved']);
        Product::factory()->create(['image' => 'product-55.jpg', 'status' => 'approved']);

        Product::factory(1000)->create(['status' => 'approved']);
    }
}
