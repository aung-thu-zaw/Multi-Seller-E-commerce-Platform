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
            'product_id' => fake()->numberBetween(),
            'comment' => fake()->numberBetween(),
            'rating' => fake()->numberBetween(1, 5),
            'is_flagged' => fake()->boolean(),
            'is_moderated' => fake()->boolean(),
            'status' => fake()->randomElement(['approved', 'rejected']),
        ];
    }
}
