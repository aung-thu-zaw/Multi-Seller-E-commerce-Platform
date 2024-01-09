<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogCategory::factory()->create(['image' => 'fashion.jpeg', 'name' => 'Fashion', 'status' => 'show']);
        BlogCategory::factory()->create(['image' => 'foods.jpeg', 'name' => 'Foods', 'status' => 'show']);
        BlogCategory::factory()->create(['image' => 'lifestyle.jpeg', 'name' => 'Lifestyle', 'status' => 'show']);
        BlogCategory::factory()->create(['image' => 'sports.jpeg', 'name' => 'Sports', 'status' => 'show']);
        BlogCategory::factory()->create(['image' => 'technology.jpeg', 'name' => 'Technology', 'status' => 'show']);
        BlogCategory::factory()->create(['image' => 'travel.jpeg', 'name' => 'Travel', 'status' => 'show']);
        BlogCategory::factory()->create(['image' => 'beauty.jpeg', 'name' => 'Beauty & Health', 'status' => 'show']);
        BlogCategory::factory()->create(['image' => 'home-improvement.jpeg', 'name' => 'Home Improvement', 'status' => 'show']);
    }
}
