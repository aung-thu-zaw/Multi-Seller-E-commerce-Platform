<?php

namespace Database\Seeders;

use App\Models\CampaignBanner;
use Illuminate\Database\Seeder;

class CampaignBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CampaignBanner::factory()->create(["image" => "campaign-banner-1.jpg","status" => "show"]);
        CampaignBanner::factory()->create(["image" => "campaign-banner-2.jpg","status" => "hide"]);

        CampaignBanner::factory(20)->create(["status" => "hide"]);
    }
}
