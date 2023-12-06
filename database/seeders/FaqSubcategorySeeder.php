<?php

namespace Database\Seeders;

use App\Models\FaqSubcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Account Managements
        FaqSubCategory::create([
         'icon' => "<i class='fa-solid fa-user-gear'></i>",
         'faq_category_id' => 1,
         'name' => 'My Account',
        ]);

        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-user-shield'></i>",
            'faq_category_id' => 1,
            'name' => 'Privacy And Security',
        ]);

        // Orders
        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-boxes-packing'></i>",
            'faq_category_id' => 2,
            'name' => 'Order Placements',
        ]);

        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-file-pen'></i>",
            'faq_category_id' => 2,
            'name' => 'Order Managements',
        ]);

        // Payments
        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-money-check-dollar'></i>",
            'faq_category_id' => 3,
            'name' => 'Payment Methods',
        ]);

        // Shipping And Delivery
        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-cart-flatbed'></i>",
            'faq_category_id' => 4,
            'name' => 'Shipping Journey',
        ]);

        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-truck-fast'></i>",
            'faq_category_id' => 4,
            'name' => 'Shop Pickup Points',
        ]);

        // Returns And Refunds
        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-right-left'></i>",
            'faq_category_id' => 5,
            'name' => 'Return Process',
        ]);

        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-money-bill-transfer'></i>",
            'faq_category_id' => 5,
            'name' => 'Refund Process',
        ]);

        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-shield'></i>",
            'faq_category_id' => 5,
            'name' => 'Warranty Policy',
        ]);

        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-right-left'></i>",
            'faq_category_id' => 5,
            'name' => 'Returns Policy',
        ]);

        FaqSubCategory::create([
            'icon' => "<i class='fa-solid fa-money-bill-transfer'></i>",
            'faq_category_id' => 5,
            'name' => 'Refunds Policy',
        ]);

        // Sell on Global E-commerce
        FaqSubcategory::create([
            'icon' => "<i class='fa-solid fa-user-tie'></i>",
            'faq_category_id' => 6,
            'name' => 'Become a Seller',
        ]);

        FaqSubcategory::create([
            'icon' => "<i class='fa-solid fa-headset'></i>",
            'faq_category_id' => 6,
            'name' => 'Seller Support',
        ]);

        // Shop Categories
        FaqSubcategory::create([
            'icon' => "<i class='fa-solid fa-store'></i>",
            'faq_category_id' => 7,
            'name' => 'Offical Store',
        ]);

        // Promotions
        FaqSubcategory::create([
            'icon' => "<i class='fa-solid fa-tags'></i>",
            'faq_category_id' => 8,
            'name' => 'Thingyan Campaign',
        ]);

        FaqSubcategory::create([
            'icon' => "<i class='fa-solid fa-file-invoice'></i>",
            'faq_category_id' => 8,
            'name' => 'Voucher Information',
        ]);

        FaqSubcategory::create([
            'icon' => "<i class='fa-solid fa-tag'></i>",
            'faq_category_id' => 8,
            'name' => 'Sales Campaing',
        ]);
    }
}
