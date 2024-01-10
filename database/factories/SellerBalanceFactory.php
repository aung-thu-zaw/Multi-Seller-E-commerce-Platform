<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SellerBalance>
 */
class SellerBalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sellers = User::where('role', 'seller')->where("status","active")
            ->pluck('id')
            ->toArray();

        return [
            'seller_id' => fake()->randomElement($sellers),
            'balance' => fake()->numberBetween(100, 1000),
        ];
    }
}
