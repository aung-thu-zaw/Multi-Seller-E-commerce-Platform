<?php

namespace Database\Factories;

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
        return [
            "user_id"=>1,
            "name"=>fake()->name(),
            "phone"=>fake()->unique()->phoneNumber(),
            "email"=>fake()->unique()->email(),
            "region"=>fake()->sentence(),
            "city"=>fake()->city(),
            "township"=>fake()->sentence(),
            "postal_code"=>fake()->postcode(),
            "address"=>fake()->address(),
            "landmark"=>fake()->sentence(),
            "is_default_billing"=>fake()->randomElement(["true","false"]),
            "is_default_delivery"=>fake()->randomElement(["true","false"]),
            "address_type"=>fake()->randomElement(["home","office"]),
        ];
    }
}
