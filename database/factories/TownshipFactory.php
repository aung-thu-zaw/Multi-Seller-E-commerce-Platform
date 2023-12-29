<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Township>
 */
class TownshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "city_id" => City::factory(),
            "name" => fake()->unique()->sentence(),
            'created_at' => fake()->dateTimeBetween('-3 months', now()),
        ];
    }
}
