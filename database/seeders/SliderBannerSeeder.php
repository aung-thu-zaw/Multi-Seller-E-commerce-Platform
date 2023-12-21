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
        SliderBanner::factory()->create(["image" => "slider-banner-1.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-2.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-3.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-4.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-5.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-6.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-7.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-8.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-9.jpg","status" => "show"]);
        SliderBanner::factory()->create(["image" => "slider-banner-10.jpg","status" => "show"]);


        SliderBanner::factory(20)->create(["status" => "hide"]);
    }
}
