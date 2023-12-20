<?php

namespace Database\Seeders;

use App\Models\ProductReviewImage;
use Illuminate\Database\Seeder;

class ProductReviewImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductReviewImage::factory(50)->create();
    }
}
