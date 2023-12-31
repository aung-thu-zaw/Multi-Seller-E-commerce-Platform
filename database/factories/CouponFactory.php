<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->word(),
            'type' => fake()->randomElement(['percentage', 'fixed']),
            'value' => fake()->numberBetween(10, 500),
            'usage_limit' => fake()->numberBetween(10, 100),
            'expiry_date' => fake()->dateTimeBetween(now(), '+2 months')->format('Y-m-d'),
            'status' => fake()->randomElement(['active', 'inactive']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
