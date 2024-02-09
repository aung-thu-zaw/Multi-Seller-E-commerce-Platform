<?php

namespace Database\Factories;

use App\Models\StoreReview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreReviewResponse>
 */
class StoreReviewResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $storeReviews = StoreReview::where('status', 'approved')->pluck('id')->toArray();

        return [
            'store_review_id' => fake()->randomElement($storeReviews),
            'store_id' => fake()->numberBetween(1, 2),
            'response' => fake()->paragraph(),
        ];
    }
}
