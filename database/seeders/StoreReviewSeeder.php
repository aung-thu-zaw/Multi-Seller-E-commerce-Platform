<?php

namespace Database\Seeders;

use App\Models\StoreReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreReview::factory(10)->create(["store_id"=>1]);
        StoreReview::factory(50)->create(["store_id"=>2]);
    }
}
