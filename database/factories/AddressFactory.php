<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Region;
use App\Models\ShippingArea;
use App\Models\Township;
use App\Models\User;
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
        $shippingAreas = ShippingArea::all();
        $users = User::pluck("id")->toArray();

        return [
            'region_id' => fake()->randomElement($shippingAreas->pluck('region_id')->toArray()),
            'city_id' => fake()->randomElement($shippingAreas->pluck('city_id')->toArray()),
            'township_id' => fake()->randomElement($shippingAreas->pluck('township_id')->toArray()),
            'user_id' => fake()->randomElement($users),
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
