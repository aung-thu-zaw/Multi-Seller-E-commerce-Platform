<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSetting::factory()->create([
            'site_name' => 'E-commerce Platform',
            'tagline' => 'Shop variety, shop local at E-commerce platform. Explore unique products, connect with sellers, and enjoy a seamless shopping experience. Elevate your online shopping journey with us',
            'copyright' => '2023 E-commerce Platform. All rights reserved.',
            'favicon' => 'favicon.png',
            'header_logo' => 'header-logo.png',
            'footer_logo' => 'footer-logo.png',
        ]);
    }
}
