<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreProductBanner>
 */
class StoreProductBannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stores = Store::where("status", "active")->pluck("id")->toArray();

        return [
            'uuid' => fake()->uuid(),
            'store_id' => fake()->randomElement($stores),
            'image' => fake()->imageUrl(),
            'url' => fake()->url(),
            'status' => fake()->randomElement(['show', 'hide']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
