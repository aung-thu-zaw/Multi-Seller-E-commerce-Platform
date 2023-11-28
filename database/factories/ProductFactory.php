<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => fake()->numberBetween(1, 67),
            'seller_id' => fake()->numberBetween(2, 3),
            'image' => fake()->imageUrl(),
            'name' => fake()->sentence(),
            'description' => fake()->text(),
            'is_top' => fake()->boolean(),
            'is_best' => fake()->boolean(),
            'is_featured' => fake()->boolean(),
            'status' => fake()->randomElement(["draft","pending","approved","rejected"])
        ];
    }
}
