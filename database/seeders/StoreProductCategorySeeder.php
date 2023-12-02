<?php

namespace Database\Seeders;

use App\Models\StoreProductCategory;
use Illuminate\Database\Seeder;

class StoreProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreProductCategory::factory(5)->create();
    }
}
