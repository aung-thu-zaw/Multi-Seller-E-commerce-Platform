<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seller_id' => fake()->randomNumber(5, 20),
            'avatar' => fake()->imageUrl(),
            'store_type' => fake()->randomElement(['official', 'non_official']),
            'name' => fake()->unique()->sentence(),
            'contact_email' => fake()->unique()->safeEmail(),
            'contact_phone' => fake()->unique()->phoneNumber(),
            'tax_number' => fake()->randomDigit(),
            'website' => fake()->url(),
            'description' => fake()->text(),
            'is_verified' => fake()->boolean(),
            'is_featured' => fake()->boolean(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
