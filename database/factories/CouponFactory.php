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
            "code" => fake()->unique()->randomLetter(),
            "type" => fake()->randomElement(['percentage', 'fixed', 'free_shipping']),
            "value" => fake()->numberBetween(10, 500),
            "usage_limit" => fake()->numberBetween(10, 100),
            "used" => 0,
            "expiry_date" => $this->faker->dateTimeBetween(now(), '+2 months')->format('Y-m-d H:i:s'),
            "status" => fake()->randomElement(["active","inactive"]),
        ];
    }
}
