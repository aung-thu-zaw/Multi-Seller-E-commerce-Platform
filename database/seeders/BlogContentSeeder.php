<?php

namespace Database\Seeders;

use App\Models\BlogContent;
use Illuminate\Database\Seeder;

class BlogContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogContent::factory(20)->create(['status' => 'draft']);

        BlogContent::factory(50)->create(['status' => 'published', 'published_at' => now()]);
    }
}
