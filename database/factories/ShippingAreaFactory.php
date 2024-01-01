<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Region;
use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingArea>
 */
class ShippingAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $regions = Region::pluck('id')->toArray();
        $cities = City::pluck('id')->toArray();
        $townships = Township::pluck('id')->toArray();

        return [
            'region_id' => fake()->randomElement($regions),
            'city_id' => fake()->randomElement($cities),
            'township_id' => fake()->randomElement($townships),
            'name' => fake()->unique()->sentence(),
        ];
    }
}
