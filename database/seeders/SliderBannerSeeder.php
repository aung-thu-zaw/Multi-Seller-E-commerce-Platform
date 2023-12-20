<?php

namespace Database\Seeders;

use App\Models\SliderBanner;
use Illuminate\Database\Seeder;

class SliderBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SliderBanner::factory(6)->create();
    }
}
