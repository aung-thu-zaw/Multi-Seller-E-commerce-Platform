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
            'store_name' => fake()->unique()->sentence(),
            'store_type' => fake()->randomElement(['personal', 'business']),
            'contact_email' => fake()->unique()->safeEmail(),
            'contact_phone' => fake()->unique()->phoneNumber(),
            'description' => fake()->text(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
