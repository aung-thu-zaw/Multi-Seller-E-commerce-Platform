<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreProductCategory>
 */
class StoreProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "store_id" => 2,
            "name" => fake()->sentence(),
            "slug" => fake()->slug(),
            'status' => fake()->randomElement(['show', 'hide']),
        ];
    }
}
