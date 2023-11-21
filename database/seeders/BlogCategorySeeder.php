<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogCategory::factory()->create(["name" => "Fashion"]);

        BlogCategory::factory()->create(["name" => "Foods"]);

        BlogCategory::factory()->create(["name" => "Lifestyle"]);

        BlogCategory::factory()->create(["name" => "Sports"]);

        BlogCategory::factory()->create(["name" => "Technology"]);

        BlogCategory::factory()->create(["name" => "Travel"]);

        BlogCategory::factory()->create(["name" => "Beauty & Health"]);

        BlogCategory::factory()->create(["name" => "Home Improvement"]);
    }
}
