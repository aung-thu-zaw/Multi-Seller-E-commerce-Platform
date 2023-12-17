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
            'store_name' => 'Business Seller',
            'store_type' => 'Business',
            'status' => 'active',
        ]);

        Store::factory()->create([
            'seller_id' => 3,
            'store_name' => 'Personal Seller',
            'store_type' => 'Personal',
            'status' => 'active',
        ]);

        Store::factory(30)->create(["seller_id" => "10","status" => "active"]);

    }
}
