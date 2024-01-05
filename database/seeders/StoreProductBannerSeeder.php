<?php

namespace Database\Seeders;

use App\Models\StoreProductBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreProductBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreProductBanner::factory(100)->create();
    }
}
