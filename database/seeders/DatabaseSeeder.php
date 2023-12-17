<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            StoreSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            // ProductImageSeeder::class,
            BlogCategorySeeder::class,
            BlogContentSeeder::class,
            BlogCommentSeeder::class,
            BlogCommentReplySeeder::class,
            // StoreProductCategorySeeder::class,
            FaqCategorySeeder::class,
            FaqSubcategorySeeder::class,
            FaqContentSeeder::class,
            HelpPageSeeder::class,
            // ProductReviewSeeder::class,
            AutomatedFilterWordSeeder::class,
            SeoSettingSeeder::class,
            GeneralSettingSeeder::class,
            SubscriberSeeder::class,
            ProductBannerSeeder::class,
            CampaignBannerSeeder::class,
            SliderBannerSeeder::class,
            CouponSeeder::class,
            CollectionSeeder::class
        ]);
    }
}
