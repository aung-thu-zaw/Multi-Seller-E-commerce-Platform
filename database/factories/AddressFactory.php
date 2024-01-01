<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Region;
use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
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
            'user_id' => 1,
            'name' => fake()->name(),
            'phone' => fake()->unique()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'postal_code' => fake()->postcode(),
            'address' => fake()->address(),
            'landmark' => fake()->sentence(),
            'is_default_billing' => fake()->randomElement(['true', 'false']),
            'is_default_delivery' => fake()->randomElement(['true', 'false']),
            'address_type' => fake()->randomElement(['home', 'office']),
        ];
    }
}
