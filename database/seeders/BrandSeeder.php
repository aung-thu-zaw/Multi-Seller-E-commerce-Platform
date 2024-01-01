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
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-1.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-2.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-3.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-4.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-5.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-6.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-7.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-8.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-9.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-10.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-11.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-12.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-13.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-14.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-15.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-16.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-17.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-18.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-19.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-20.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-21.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-22.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-23.png']);
        Brand::factory()->create(['status' => 'active', 'logo' => 'brand-24.png']);
    }
}
