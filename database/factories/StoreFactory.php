<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seller = User::where('role', 'seller')->where('status', 'active')->pluck('id')->toArray();

        return [
            'seller_id' => fake()->randomElement($seller),
            'avatar' => fake()->imageUrl(),
            'cover' => fake()->imageUrl(),
            'store_name' => fake()->unique()->sentence(),
            'store_type' => fake()->randomElement(['personal', 'business']),
            'contact_email' => fake()->unique()->safeEmail(),
            'contact_phone' => fake()->unique()->phoneNumber(),
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
