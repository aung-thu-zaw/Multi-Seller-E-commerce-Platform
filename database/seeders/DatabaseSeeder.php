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
            CategorySeeder::class,
            BrandSeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            FlashSaleSeeder::class,
            CollectionSeeder::class,
            SliderBannerSeeder::class,
            CampaignBannerSeeder::class,
            ProductBannerSeeder::class,
            CouponSeeder::class,
            RegionSeeder::class,
            CitySeeder::class,
            TownshipSeeder::class,
            ShippingMethodSeeder::class,
            // ShippingAreaSeeder::class,
            // ShippingRateSeeder::class,
            // AddressSeeder::class,
            // AttributeSeeder::class,
            // AttributeOptionSeeder::class,
            BlogCategorySeeder::class,
            BlogContentSeeder::class,
            BlogCommentSeeder::class,
            BlogCommentReplySeeder::class,
            AutomatedFilterWordSeeder::class,
            ProductReviewSeeder::class,
            ProductReviewImageSeeder::class,
            ProductReviewResponseSeeder::class,
            StoreReviewSeeder::class,
            StoreReviewResponseSeeder::class,
            SellerRequestSeeder::class,
            ProductQuestionSeeder::class,
            ProductQuestionAnswerSeeder::class,
            FaqCategorySeeder::class,
            FaqSubcategorySeeder::class,
            FaqContentSeeder::class,
            HelpPageSeeder::class,
            SubscriberSeeder::class,
            SearchHistorySeeder::class,
            UserProductViewSeeder::class,
            StoreProductCategorySeeder::class,
            StoreProductBannerSeeder::class,
            GeneralSettingSeeder::class,
            SeoSettingSeeder::class,
            // DeliveryServiceRatingSeeder::class,
            // EmailConfigurationSeeder::class,
            // PaymentConfigurationSeeder::class,
        ]);
    }
}
