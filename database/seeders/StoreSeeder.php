<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Store::factory()->create([
            'seller_id' => 2,
            'store_type' => 'official',
            'name' => 'Official Seller',
            'is_verified' => true,
            'is_featured' => true,
            'status' => 'active',
        ]);

        Store::factory()->create([
            'seller_id' => 3,
            'store_type' => 'non_official',
            'name' => 'Unofficial Seller',
            'is_verified' => true,
            'is_featured' => true,
            'status' => 'active',
        ]);

    }
}
