<?php

namespace Database\Factories;

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
        return [
            "store_review_id"=>fake()->numberBetween(1,10),
            "store_id"=>fake()->numberBetween(1,2),
            "response"=>fake()->paragraph(),
        ];
    }
}
