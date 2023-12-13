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
            'store_type' => 'Business',
            'store_name' => 'Business Seller',
            'is_verified' => true,
            'status' => 'active',
        ]);

        Store::factory()->create([
            'seller_id' => 3,
            'store_type' => 'Personal',
            'store_name' => 'Personal Seller',
            'is_verified' => true,
            'status' => 'active',
        ]);

    }
}
