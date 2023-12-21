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
        Category::create(['name' => 'Apparel & Beauty',"status" => "show"]);
        Category::create(['name' => 'Foods & Groceries',"status" => "show"]);
        Category::create(['name' => 'Sport Accessories',"status" => "show"]);
        Category::create(['name' => 'Electronic Devices',"status" => "show"]);
        Category::create(['name' => 'Electronic Accessories',"status" => "show"]);
        Category::create(['name' => 'Home Appliances',"status" => "show"]);
        Category::create(['name' => 'Babies & Toys',"status" => "show"]);
        Category::create(['name' => 'Pet Accessories',"status" => "show"]);

        // ===== Second Child Categories =====

        // 1.Apparel And Beauty
        Category::create(['parent_id' => 1, 'name' => 'Hair Care',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Makeup',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Personal Cares',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Beauty Tools',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Wedding Apparel & Accessories',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Beauty Equipment',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Sportswear',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Perfume and Fragrance',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => "Men's Care","status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Ethnic Clothing',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Garment & Processing Accessories',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Skin Care',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Fashion',"status" => "show"]);
        Category::create(['parent_id' => 1, 'name' => 'Other Apparel',"status" => "show"]);

        // 2.Foods And Groceries
        Category::create(['parent_id' => 2, 'name' => 'Snacks',"status" => "show"]);
        Category::create(['parent_id' => 2, 'name' => 'Drinks',"status" => "show"]);
        Category::create(['parent_id' => 2, 'name' => 'Breakfast',"status" => "show"]);
        Category::create(['parent_id' => 2, 'name' => 'Canned Dry & Packaged Foods',"status" => "show"]);
        Category::create(['parent_id' => 2, 'name' => 'Jarred Food',"status" => "show"]);
        Category::create(['parent_id' => 2, 'name' => 'Fruit & Vegetables',"status" => "show"]);
        Category::create(['parent_id' => 2, 'name' => 'Meats',"status" => "show"]);
        Category::create(['parent_id' => 2, 'name' => 'Other Goods',"status" => "show"]);

        // 3.port Accessories
        Category::create(['parent_id' => 3, 'name' => 'Water Sports',"status" => "show"]);
        Category::create(['parent_id' => 3, 'name' => 'Team Sports',"status" => "show"]);
        Category::create(['parent_id' => 3, 'name' => 'Exercise & Fitness',"status" => "show"]);
        Category::create(['parent_id' => 3, 'name' => 'Boxing & Material Arts',"status" => "show"]);
        Category::create(['parent_id' => 3, 'name' => 'Outdoor Sports',"status" => "show"]);
        Category::create(['parent_id' => 3, 'name' => 'Sports Clothing',"status" => "show"]);
        Category::create(['parent_id' => 3, 'name' => 'Other Sport Accessories',"status" => "show"]);

        // 4.Electronic Devices
        Category::create(['parent_id' => 4, 'name' => 'Mobiles',"status" => "show"]);
        Category::create(['parent_id' => 4, 'name' => 'Tablets',"status" => "show"]);
        Category::create(['parent_id' => 4, 'name' => 'Security Cameras',"status" => "show"]);
        Category::create(['parent_id' => 4, 'name' => 'Gaming Consoles',"status" => "show"]);
        Category::create(['parent_id' => 4, 'name' => 'Digital Cameras',"status" => "show"]);
        Category::create(['parent_id' => 4, 'name' => 'Computers',"status" => "show"]);
        Category::create(['parent_id' => 4, 'name' => 'Other Devices',"status" => "show"]);

        // 5.Electronic Accessories
        Category::create(['parent_id' => 5, 'name' => 'Mobile Accessories',"status" => "show"]);
        Category::create(['parent_id' => 5, 'name' => 'Laptop Accessories',"status" => "show"]);
        Category::create(['parent_id' => 5, 'name' => 'Desktop Accessories',"status" => "show"]);
        Category::create(['parent_id' => 5, 'name' => 'Console Accessories',"status" => "show"]);
        Category::create(['parent_id' => 5, 'name' => 'Printers',"status" => "show"]);
        Category::create(['parent_id' => 5, 'name' => 'Chargers, Batteries & Power Supplies',"status" => "show"]);
        Category::create(['parent_id' => 5, 'name' => 'Storage',"status" => "show"]);
        Category::create(['parent_id' => 5, 'name' => 'Cables & Commonly Used Accessories',"status" => "show"]);

        // 6.Home Appliances
        Category::create(['parent_id' => 6, 'name' => 'Furniture',"status" => "show"]);
        Category::create(['parent_id' => 6, 'name' => 'Cleaning Tools & Accessories',"status" => "show"]);
        Category::create(['parent_id' => 6, 'name' => 'Laundary & Cleaning',"status" => "show"]);
        Category::create(['parent_id' => 6, 'name' => 'Kitchen & Dining',"status" => "show"]);
        Category::create(['parent_id' => 6, 'name' => 'Bath Accessories',"status" => "show"]);
        Category::create(['parent_id' => 6, 'name' => 'Bed Accessories',"status" => "show"]);
        Category::create(['parent_id' => 6, 'name' => 'Lighting',"status" => "show"]);

        // 7.Babies And Toys
        Category::create(['parent_id' => 7, 'name' => 'Baby Clothing',"status" => "show"]);
        Category::create(['parent_id' => 7, 'name' => 'Feeding',"status" => "show"]);
        Category::create(['parent_id' => 7, 'name' => 'Toys & Games',"status" => "show"]);
        Category::create(['parent_id' => 7, 'name' => 'Baby Personal Care',"status" => "show"]);
        Category::create(['parent_id' => 7, 'name' => 'Diapering & Potty',"status" => "show"]);

        // 8.Pet Accessories
        Category::create(['parent_id' => 8, 'name' => 'Cat Foods And Accessories',"status" => "show"]);
        Category::create(['parent_id' => 8, 'name' => 'Dog Foods And Accessories',"status" => "show"]);
        Category::create(['parent_id' => 8, 'name' => 'Other Pet Accessories',"status" => "show"]);

        // Third Child Category
        Category::factory(100)->create(["status" => "show"]);

    }
}
