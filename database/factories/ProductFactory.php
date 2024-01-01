<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = Brand::where('status', 'active')->pluck('id')->toArray();

        return [
            'category_id' => fake()->numberBetween(1, 67),
            'brand_id' => fake()->randomElement($brands),
            'store_id' => fake()->numberBetween(1, 2),
            'image' => fake()->imageUrl(),
            'name' => fake()->sentence(),
            'description' => fake()->text(),
            'qty' => fake()->numberBetween(5, 100),
            'price' => fake()->numberBetween(10, 500),
            'sku' => uniqid(),
            'status' => fake()->randomElement(['draft', 'pending', 'approved', 'rejected']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
