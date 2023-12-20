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
        StoreReview::factory(1)->create(['store_id' => 1, 'status' => 'approved', 'rating' => 1]);
        StoreReview::factory(2)->create(['store_id' => 1, 'status' => 'approved', 'rating' => 2]);
        StoreReview::factory(3)->create(['store_id' => 1, 'status' => 'approved', 'rating' => 3]);
        StoreReview::factory(4)->create(['store_id' => 1, 'status' => 'approved', 'rating' => 4]);
        StoreReview::factory(5)->create(['store_id' => 1, 'status' => 'approved', 'rating' => 5]);
        StoreReview::factory(10)->create(['store_id' => 2, 'status' => 'approved']);
    }
}
