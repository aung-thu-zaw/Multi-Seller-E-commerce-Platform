<?php

namespace Database\Factories;

use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReviewResponse>
 */
class ProductReviewResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productReviews = ProductReview::where('status', 'approved')->pluck('id')->toArray();

        return [
            'product_review_id' => fake()->randomElement($productReviews),
            'store_id' => fake()->numberBetween(1, 2),
            'response' => fake()->paragraph(),
        ];
    }
}
