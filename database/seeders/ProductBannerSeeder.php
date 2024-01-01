<?php

namespace Database\Seeders;

use App\Models\ProductBanner;
use Illuminate\Database\Seeder;

class ProductBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductBanner::factory()->create(['image' => 'product-banner-1.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-2.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-3.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-4.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-5.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-6.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-7.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-8.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-9.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-10.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-11.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-12.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-13.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-14.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-15.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-16.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-17.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-18.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-19.jpeg', 'status' => 'show']);
        ProductBanner::factory()->create(['image' => 'product-banner-20.jpeg', 'status' => 'show']);

        ProductBanner::factory(20)->create(['status' => 'hide']);
    }
}
