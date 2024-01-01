<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
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
            'name' => fake()->unique()->sentence(2),
            'logo' => fake()->imageUrl(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
