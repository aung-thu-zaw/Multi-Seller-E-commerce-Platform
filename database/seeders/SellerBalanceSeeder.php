<?php

namespace Database\Seeders;

use App\Models\SellerBalance;
use Illuminate\Database\Seeder;

class SellerBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SellerBalance::factory()->create(["seller_id" => 3]);
        SellerBalance::factory(30)->create();
    }
}
