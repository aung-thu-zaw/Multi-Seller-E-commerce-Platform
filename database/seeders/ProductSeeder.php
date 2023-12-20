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
        Product::factory(50)->create(['store_id' => 1, 'status' => 'approved']);
        Product::factory(50)->create(['store_id' => 2, 'status' => 'approved']);
    }
}
