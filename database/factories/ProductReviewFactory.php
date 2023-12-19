<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(3, 50),
            'store_id'=>fake()->numberBetween(2,10),
            'product_id' => fake()->numberBetween(1, 100),
            'comment' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
            'is_flagged' => fake()->boolean(),
            'is_moderated' => fake()->boolean(),
            'status' => fake()->randomElement(['approved', 'rejected']),
        ];
    }
}
