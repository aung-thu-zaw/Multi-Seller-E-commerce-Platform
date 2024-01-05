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
            'seller_id' => 3,
            'store_type' => 'business',
            'status' => 'active',
        ]);

        Store::factory(10)->create();
    }
}
