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
        ProductReview::factory(1)->create(["store_id" => 1,"status" => "approved","rating"=>1]);
        ProductReview::factory(2)->create(["store_id" => 1,"status" => "approved","rating"=>2]);
        ProductReview::factory(3)->create(["store_id" => 1,"status" => "approved","rating"=>3]);
        ProductReview::factory(4)->create(["store_id" => 1,"status" => "approved","rating"=>4]);
        ProductReview::factory(5)->create(["store_id" => 1,"status" => "approved","rating"=>5]);
        ProductReview::factory(10)->create(["store_id" => 2,"status" => "approved"]);
    }
}
