<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ===== Parent Categories =====
        Category::factory()->create(['name' => 'Apparel & Beauty']);
        Category::factory()->create(['name' => 'Foods & Groceries']);
        Category::factory()->create(['name' => 'Sport Accessories']);
        Category::factory()->create(['name' => 'Electronic Devices']);
        Category::factory()->create(['name' => 'Electronic Accessories']);
        Category::factory()->create(['name' => 'Home Appliances']);
        Category::factory()->create(['name' => 'Babies & Toys']);
        Category::factory()->create(['name' => 'Pet Accessories']);

        // ===== Child Categories =====

        // 1.Apparel And Beauty
        Category::factory()->create(['parent_id' => 1, 'name' => 'Hair Care']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Makeup']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Personal Cares']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Beauty Tools']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Wedding Apparel & Accessories']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Beauty Equipment']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Sportswear']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Perfume and Fragrance']);
        Category::factory()->create(['parent_id' => 1, 'name' => "Men's Care"]);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Ethnic Clothing']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Garment & Processing Accessories']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Skin Care']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Fashion']);
        Category::factory()->create(['parent_id' => 1, 'name' => 'Other Apparel']);

        // 2.Foods And Groceries
        Category::factory()->create(['parent_id' => 2, 'name' => 'Snacks']);
        Category::factory()->create(['parent_id' => 2, 'name' => 'Drinks']);
        Category::factory()->create(['parent_id' => 2, 'name' => 'Breakfast']);
        Category::factory()->create(['parent_id' => 2, 'name' => 'Canned Dry & Packaged Foods']);
        Category::factory()->create(['parent_id' => 2, 'name' => 'Jarred Food']);
        Category::factory()->create(['parent_id' => 2, 'name' => 'Fruit & Vegetables']);
        Category::factory()->create(['parent_id' => 2, 'name' => 'Meats']);
        Category::factory()->create(['parent_id' => 2, 'name' => 'Other Goods']);

        // 3.port Accessories
        Category::factory()->create(['parent_id' => 3, 'name' => 'Water Sports']);
        Category::factory()->create(['parent_id' => 3, 'name' => 'Team Sports']);
        Category::factory()->create(['parent_id' => 3, 'name' => 'Exercise & Fitness']);
        Category::factory()->create(['parent_id' => 3, 'name' => 'Boxing & Material Arts']);
        Category::factory()->create(['parent_id' => 3, 'name' => 'Outdoor Sports']);
        Category::factory()->create(['parent_id' => 3, 'name' => 'Sports Clothing']);
        Category::factory()->create(['parent_id' => 3, 'name' => 'Other Sport Accessories']);

        // 4.Electronic Devices
        Category::factory()->create(['parent_id' => 4, 'name' => 'Mobiles']);
        Category::factory()->create(['parent_id' => 4, 'name' => 'Tablets']);
        Category::factory()->create(['parent_id' => 4, 'name' => 'Security Cameras']);
        Category::factory()->create(['parent_id' => 4, 'name' => 'Gaming Consoles']);
        Category::factory()->create(['parent_id' => 4, 'name' => 'Digital Cameras']);
        Category::factory()->create(['parent_id' => 4, 'name' => 'Computers']);
        Category::factory()->create(['parent_id' => 4, 'name' => 'Other Devices']);

        // 5.Electronic Accessories
        Category::factory()->create(['parent_id' => 5, 'name' => 'Mobile Accessories']);
        Category::factory()->create(['parent_id' => 5, 'name' => 'Laptop Accessories']);
        Category::factory()->create(['parent_id' => 5, 'name' => 'Desktop Accessories']);
        Category::factory()->create(['parent_id' => 5, 'name' => 'Console Accessories']);
        Category::factory()->create(['parent_id' => 5, 'name' => 'Printers']);
        Category::factory()->create(['parent_id' => 5, 'name' => 'Chargers, Batteries & Power Supplies']);
        Category::factory()->create(['parent_id' => 5, 'name' => 'Storage']);
        Category::factory()->create(['parent_id' => 5, 'name' => 'Cables & Commonly Used Accessories']);

        // 6.Home Appliances
        Category::factory()->create(['parent_id' => 6, 'name' => 'Furniture']);
        Category::factory()->create(['parent_id' => 6, 'name' => 'Cleaning Tools & Accessories']);
        Category::factory()->create(['parent_id' => 6, 'name' => 'Laundary & Cleaning']);
        Category::factory()->create(['parent_id' => 6, 'name' => 'Kitchen & Dining']);
        Category::factory()->create(['parent_id' => 6, 'name' => 'Bath Accessories']);
        Category::factory()->create(['parent_id' => 6, 'name' => 'Bed Accessories']);
        Category::factory()->create(['parent_id' => 6, 'name' => 'Lighting']);

        // 7.Babies And Toys
        Category::factory()->create(['parent_id' => 7, 'name' => 'Baby Clothing']);
        Category::factory()->create(['parent_id' => 7, 'name' => 'Feeding']);
        Category::factory()->create(['parent_id' => 7, 'name' => 'Toys & Games']);
        Category::factory()->create(['parent_id' => 7, 'name' => 'Baby Personal Care']);
        Category::factory()->create(['parent_id' => 7, 'name' => 'Diapering & Potty']);

        // 8.Pet Accessories
        Category::factory()->create(['parent_id' => 8, 'name' => 'Cat Foods And Accessories']);
        Category::factory()->create(['parent_id' => 8, 'name' => 'Dog Foods And Accessories']);
        Category::factory()->create(['parent_id' => 8, 'name' => 'Other Pet Accessories']);
    }
}
