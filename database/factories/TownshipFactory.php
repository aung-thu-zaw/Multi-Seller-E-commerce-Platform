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
        $cities = City::pluck('id')->toArray();

        return [
            'city_id' => fake()->randomElement($cities),
            'name' => fake()->unique()->city(),
            'created_at' => fake()->dateTimeBetween('-3 months', now()),
        ];
    }
}
