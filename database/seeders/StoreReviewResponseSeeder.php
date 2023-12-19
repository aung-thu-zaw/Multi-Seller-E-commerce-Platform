<?php

namespace Database\Seeders;

use App\Models\StoreReview;
use App\Models\StoreReviewResponse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreReviewResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreReviewResponse::factory(10)->create();
    }
}
