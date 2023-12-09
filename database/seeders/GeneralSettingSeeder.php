<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSetting::create(["key" => "site_name","value" => ""]);
        GeneralSetting::create(["key" => "tagline","value" => ""]);
        GeneralSetting::create(["key" => "favicon","value" => ""]);
        GeneralSetting::create(["key" => "header_logo","value" => ""]);
        GeneralSetting::create(["key" => "footer_logo","value" => ""]);
        GeneralSetting::create(["key" => "company_phone","value" => ""]);
        GeneralSetting::create(["key" => "company_email","value" => ""]);
        GeneralSetting::create(["key" => "company_address","value" => ""]);
        GeneralSetting::create(["key" => "support_phone","value" => ""]);
        GeneralSetting::create(["key" => "support_email","value" => ""]);
        GeneralSetting::create(["key" => "support_address","value" => ""]);
        GeneralSetting::create(["key" => "copyright","value" => ""]);
        GeneralSetting::create(["key" => "facebook_url","value" => ""]);
        GeneralSetting::create(["key" => "twitter_url","value" => ""]);
        GeneralSetting::create(["key" => "instagram_url","value" => ""]);
        GeneralSetting::create(["key" => "linked_in_url","value" => ""]);
        GeneralSetting::create(["key" => "youtube_url","value" => ""]);
    }
}
