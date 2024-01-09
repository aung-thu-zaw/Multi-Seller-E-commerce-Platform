<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ===== Parent Categories =====
        Category::create(['image' => 'apparel-and-beauty.png', 'name' => 'Apparel & Beauty', 'status' => 'show']);
        Category::create(['image' => 'food-and-groceries.jpeg', 'name' => 'Foods & Groceries', 'status' => 'show']);
        Category::create(['image' => 'sport-accessories.jpeg', 'name' => 'Sport Accessories', 'status' => 'show']);
        Category::create(['image' => 'electronic-devices.jpeg', 'name' => 'Electronic Devices', 'status' => 'show']);
        Category::create(['image' => 'electronic-accessories.jpeg', 'name' => 'Electronic Accessories', 'status' => 'show']);
        Category::create(['image' => 'home-appliance.jpeg', 'name' => 'Home Appliances', 'status' => 'show']);
        Category::create(['image' => 'babies-and-toys.jpeg', 'name' => 'Babies & Toys', 'status' => 'show']);
        Category::create(['image' => 'pet-accessories.jpeg', 'name' => 'Pet Accessories', 'status' => 'show']);

        // ===== Second Child Categories =====

        // 1.Apparel And Beauty
        Category::create(['parent_id' => 1, 'image' => 'hair-care.jpeg', 'name' => 'Hair Care', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'makeup.jpeg', 'name' => 'Makeup', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'personal-care.jpeg', 'name' => 'Personal Cares', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'beauty-tools.jpeg', 'name' => 'Beauty Tools', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'wedding-apparel-and-accessories.jpeg', 'name' => 'Wedding Apparel & Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'beauty-equipment.jpeg', 'name' => 'Beauty Equipment', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'sports-wear.jpeg', 'name' => 'Sportswear', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'perfume-and-fragrance.jpeg', 'name' => 'Perfume and Fragrance', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'men-care.jpeg', 'name' => "Men's Care", 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'ethnic-clothing.jpeg', 'name' => 'Ethnic Clothing', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'garment-accessories.jpg', 'name' => 'Garment & Processing Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'skin-care.jpeg', 'name' => 'Skin Care', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'fashion.jpeg', 'name' => 'Fashion', 'status' => 'show']);
        Category::create(['parent_id' => 1, 'image' => 'other-apparel.jpeg', 'name' => 'Other Apparel', 'status' => 'show']);

        // 2.Foods And Groceries
        Category::create(['parent_id' => 2, 'image' => 'snacks.jpeg', 'name' => 'Snacks', 'status' => 'show']);
        Category::create(['parent_id' => 2, 'image' => 'drinks.jpeg', 'name' => 'Drinks', 'status' => 'show']);
        Category::create(['parent_id' => 2, 'image' => 'breakfast.jpeg', 'name' => 'Breakfast', 'status' => 'show']);
        Category::create(['parent_id' => 2, 'image' => 'canned-dry.jpeg', 'name' => 'Canned Dry & Packaged Foods', 'status' => 'show']);
        Category::create(['parent_id' => 2, 'image' => 'jarred-food.jpeg', 'name' => 'Jarred Food', 'status' => 'show']);
        Category::create(['parent_id' => 2, 'image' => 'fruits-and-vegetables.jpeg', 'name' => 'Fruit & Vegetables', 'status' => 'show']);
        Category::create(['parent_id' => 2, 'image' => 'meats.jpeg', 'name' => 'Meats', 'status' => 'show']);
        Category::create(['parent_id' => 2, 'image' => 'goods.jpeg', 'name' => 'Other Goods', 'status' => 'show']);

        // 3.port Accessories
        Category::create(['parent_id' => 3, 'image' => 'water-sports.jpeg', 'name' => 'Water Sports', 'status' => 'show']);
        Category::create(['parent_id' => 3, 'image' => 'team-sports.jpeg', 'name' => 'Team Sports', 'status' => 'show']);
        Category::create(['parent_id' => 3, 'image' => 'exercises-and-fitness.jpeg', 'name' => 'Exercise & Fitness', 'status' => 'show']);
        Category::create(['parent_id' => 3, 'image' => 'martial-arts.jpeg', 'name' => 'Boxing & Material Arts', 'status' => 'show']);
        Category::create(['parent_id' => 3, 'image' => 'outdoor-sports.jpeg', 'name' => 'Outdoor Sports', 'status' => 'show']);
        Category::create(['parent_id' => 3, 'image' => 'sport-clothing.jpeg', 'name' => 'Sports Clothing', 'status' => 'show']);
        Category::create(['parent_id' => 3, 'image' => 'other-sport-accessories.jpeg', 'name' => 'Other Sport Accessories', 'status' => 'show']);

        // 4.Electronic Devices
        Category::create(['parent_id' => 4, 'image' => 'mobiles.jpeg', 'name' => 'Mobiles', 'status' => 'show']);
        Category::create(['parent_id' => 4, 'image' => 'tablets.webp', 'name' => 'Tablets', 'status' => 'show']);
        Category::create(['parent_id' => 4, 'image' => 'security-cameras.jpeg', 'name' => 'Security Cameras', 'status' => 'show']);
        Category::create(['parent_id' => 4, 'image' => 'gaming-consoles.webp', 'name' => 'Gaming Consoles', 'status' => 'show']);
        Category::create(['parent_id' => 4, 'image' => 'digital-cameras.jpeg', 'name' => 'Digital Cameras', 'status' => 'show']);
        Category::create(['parent_id' => 4, 'image' => 'computers.jpeg', 'name' => 'Computers', 'status' => 'show']);
        Category::create(['parent_id' => 4, 'image' => 'other-devices.jpeg', 'name' => 'Other Devices', 'status' => 'show']);

        // 5.Electronic Accessories
        Category::create(['parent_id' => 5, 'image' => 'mobile-accessories.jpeg', 'name' => 'Mobile Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 5, 'image' => 'laptop-accessories.jpeg', 'name' => 'Laptop Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 5, 'image' => 'desktop-accessories.jpeg', 'name' => 'Desktop Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 5, 'image' => 'console-accessories.jpeg', 'name' => 'Console Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 5, 'image' => 'printers.webp', 'name' => 'Printers', 'status' => 'show']);
        Category::create(['parent_id' => 5, 'image' => 'chargers.jpeg', 'name' => 'Chargers, Batteries & Power Supplies', 'status' => 'show']);
        Category::create(['parent_id' => 5, 'image' => 'storage', 'name' => 'Storage', 'status' => 'show']);
        Category::create(['parent_id' => 5, 'image' => 'cables.jpeg', 'name' => 'Cables & Commonly Used Accessories', 'status' => 'show']);

        // 6.Home Appliances
        Category::create(['parent_id' => 6, 'image' => 'furniture.jpeg', 'name' => 'Furniture', 'status' => 'show']);
        Category::create(['parent_id' => 6, 'image' => 'cleaning-tools.jpeg', 'name' => 'Cleaning Tools & Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 6, 'image' => 'laundry-and-cleaning.jpeg', 'name' => 'Laundry & Cleaning', 'status' => 'show']);
        Category::create(['parent_id' => 6, 'image' => 'kitchen-and-dinning.jpeg', 'name' => 'Kitchen & Dining', 'status' => 'show']);
        Category::create(['parent_id' => 6, 'image' => 'bath-accessories.webp', 'name' => 'Bath Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 6, 'image' => 'bed-accessories.webp', 'name' => 'Bed Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 6, 'image' => 'lighting.jpeg', 'name' => 'Lighting', 'status' => 'show']);

        // 7.Babies And Toys
        Category::create(['parent_id' => 7, 'image' => 'baby-clothing.jpeg', 'name' => 'Baby Clothing', 'status' => 'show']);
        Category::create(['parent_id' => 7, 'image' => 'feeding.jpeg', 'name' => 'Feeding', 'status' => 'show']);
        Category::create(['parent_id' => 7, 'image' => 'toys-and-games.jpeg', 'name' => 'Toys & Games', 'status' => 'show']);
        Category::create(['parent_id' => 7, 'image' => 'baby-personal-care.jpeg', 'name' => 'Baby Personal Care', 'status' => 'show']);
        Category::create(['parent_id' => 7, 'image' => 'diapering-and-potty.jpeg', 'name' => 'Diapering & Potty', 'status' => 'show']);

        // 8.Pet Accessories
        Category::create(['parent_id' => 8, 'image' => 'cat-foods.webp', 'name' => 'Cat Foods And Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 8, 'image' => 'dog-foods.jpeg', 'name' => 'Dog Foods And Accessories', 'status' => 'show']);
        Category::create(['parent_id' => 8, 'image' => 'pet-accessories.jpeg', 'name' => 'Other Pet Accessories', 'status' => 'show']);

        // Third Child Category
        Category::factory(100)->create(['status' => 'show']);

    }
}
