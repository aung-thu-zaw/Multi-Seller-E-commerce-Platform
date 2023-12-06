<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FaqCategory::create(['name' => 'Account Managements']);

        FaqCategory::create(['name' => 'Orders']);

        FaqCategory::create(['name' => 'Payments']);

        FaqCategory::create(['name' => 'Shipping And Delivery']);

        FaqCategory::create(['name' => 'Returns And Refunds']);

        FaqCategory::create(['name' => 'Sell on E-commerce']);

        FaqCategory::create(['name' => 'Shop Categories']);

        FaqCategory::create(['name' => 'Promotions']);
    }
}
