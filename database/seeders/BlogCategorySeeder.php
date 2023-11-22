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
        BlogCategory::factory()->create(['name' => 'Fashion','status' => 'show']);

        BlogCategory::factory()->create(['name' => 'Foods','status' => 'show']);

        BlogCategory::factory()->create(['name' => 'Lifestyle','status' => 'show']);

        BlogCategory::factory()->create(['name' => 'Sports','status' => 'show']);

        BlogCategory::factory()->create(['name' => 'Technology','status' => 'show']);

        BlogCategory::factory()->create(['name' => 'Travel','status' => 'show']);

        BlogCategory::factory()->create(['name' => 'Beauty & Health','status' => 'show']);

        BlogCategory::factory()->create(['name' => 'Home Improvement','status' => 'show']);
    }
}
