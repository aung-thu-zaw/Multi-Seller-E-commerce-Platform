<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use App\Models\BusinessInformation;
use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store=Store::factory()->create([
            'seller_id' => 3,
            'store_type' => 'business',
            'status' => 'active',
        ]);

        BusinessInformation::create(["seller_id"=>$store->seller_id]);
        BankAccount::create(["seller_id"=>$store->seller_id]);

        Store::factory(20)->create(['status' => 'active']);
    }
}
