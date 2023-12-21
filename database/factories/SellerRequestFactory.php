<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SellerRequest>
 */
class SellerRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::where("role", "user")->pluck("id")->toArray();

        return [
            "user_id" => fake()->randomElement($user),
            "store_name" => fake()->unique()->sentence(),
            "store_type" => fake()->randomElement(["personal","business"]),
            "contact_email" => fake()->unique()->safeEmail(),
            "contact_phone" => fake()->unique()->phoneNumber(),
            "address" => fake()->address(),
            "additional_information" => fake()->paragraph(),
            "status" => fake()->randomElement(["pending","approved","rejected"]),
            'created_at' => fake()->dateTimeBetween('-2 months', now()),
        ];
    }
}
