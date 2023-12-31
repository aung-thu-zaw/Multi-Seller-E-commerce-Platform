<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $regions = Region::pluck('id')->toArray();

        return [
            'region_id' => fake()->randomElement($regions),
            'name' => fake()->unique()->city(),
            'created_at' => fake()->dateTimeBetween('-3 months', now()),
        ];
    }
}
