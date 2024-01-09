<?php

namespace Database\Factories;

use App\Models\Category;
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
        $categories = Category::where('status', 'show')->pluck('id')->toArray();

        return [
            'category_id' => fake()->randomElement($categories),
            'name' => fake()->unique()->sentence(2),
            'logo' => fake()->imageUrl(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
