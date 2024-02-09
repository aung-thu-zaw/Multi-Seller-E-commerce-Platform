<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SliderBanner>
 */
class SliderBannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => fake()->imageUrl(),
            'url' => fake()->url(),
            'status' => fake()->randomElement(['show', 'hide']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
