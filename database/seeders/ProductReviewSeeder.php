<?php

namespace Database\Seeders;

use App\Models\ProductReview;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductReview::factory(25)->create(["store_id" => 1,"status" => "approved"]);
        ProductReview::factory(10)->create(["store_id" => 2,"status" => "approved"]);
    }
}
