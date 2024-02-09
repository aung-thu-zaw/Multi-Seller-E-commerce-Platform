<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => fake()->numberBetween(9, 67),
            'name' => fake()->unique()->word(),
            'image' => fake()->imageUrl(),
            'status' => fake()->randomElement(['show', 'hide']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
