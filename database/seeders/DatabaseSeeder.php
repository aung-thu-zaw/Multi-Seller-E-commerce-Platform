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
            // AssignRolePermissionsSeeder::class,
            UserSeeder::class,
            StoreSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            FlashSaleSeeder::class,
            CollectionSeeder::class,
            SliderBannerSeeder::class,
            CampaignBannerSeeder::class,
            ProductBannerSeeder::class,
            CouponSeeder::class,
            BlogCategorySeeder::class,
            BlogContentSeeder::class,
            BlogCommentSeeder::class,
            BlogCommentReplySeeder::class,
            AutomatedFilterWordSeeder::class,
            // ProductReviewAndRatingSeeder::class,
            // StoreReviewAndRatingSeeder::class,
            // DeliveryServiceRatingSeeder::class,
            SellerRequestSeeder::class,
            StoreSeeder::class,
            SubscriberSeeder::class,
            FaqCategorySeeder::class,
            FaqSubcategorySeeder::class,
            FaqContentSeeder::class,
            HelpPageSeeder::class,
            GeneralSettingSeeder::class,
            SeoSettingSeeder::class,
            // EmailConfigurationSeeder::class,
            // PaymentConfigurationSeeder::class,



            // StoreProductCategorySeeder::class,
            ProductReviewSeeder::class,
            // StoreReviewSeeder::class,
            // ProductReviewResponseSeeder::class,
            // StoreReviewResponseSeeder::class,
            // ProductReviewImageSeeder::class,
            // ProductQuestionSeeder::class,
            // ProductQuestionAnswerSeeder::class,

            SearchHistorySeeder::class
        ]);
    }
}
