<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->create(["status" => "active","logo" => "brand-1.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-2.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-3.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-4.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-5.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-6.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-7.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-8.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-9.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-10.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-11.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-12.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-13.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-14.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-15.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-16.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-17.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-18.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-19.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-20.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-21.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-22.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-23.jpg"]);
        Brand::factory()->create(["status" => "active","logo" => "brand-24.jpg"]);
    }
}
