<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreProductCategory>
 */
class StoreProductCategoryFactory extends Factory
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
            'store_id' => fake()->randomElement($stores) ,
            'name' => fake()->sentence(),
            'status' => fake()->randomElement(['show', 'hide']),
        ];
    }
}
