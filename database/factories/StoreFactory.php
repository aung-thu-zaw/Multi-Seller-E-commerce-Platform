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
            'seller_id' => fake()->randomNumber(2, 20),
            'avatar' => fake()->imageUrl(),
            'store_type' => fake()->randomElement(['personal', 'business']),
            'store_name' => fake()->unique()->sentence(),
            'contact_email' => fake()->unique()->safeEmail(),
            'contact_phone' => fake()->unique()->phoneNumber(),
            'tax_number' => fake()->randomDigit(),
            'description' => fake()->text(),
            'is_verified' => fake()->boolean(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
