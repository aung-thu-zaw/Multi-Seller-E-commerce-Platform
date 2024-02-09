<?php

namespace Database\Seeders;

use App\Models\StoreReview;
use Illuminate\Database\Seeder;

class StoreReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreReview::factory(100)->create(['status' => 'approved']);
    }
}
