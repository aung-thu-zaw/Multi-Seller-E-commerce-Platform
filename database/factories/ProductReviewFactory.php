<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::where('status', 'active')->pluck('id')->toArray();
        $stores = Store::where('status', 'active')->pluck('id')->toArray();
        $products = Product::where('status', 'approved')->pluck('id')->toArray();

        return [
            'user_id' => fake()->randomElement($users),
            'store_id' => fake()->randomElement($stores),
            'product_id' => fake()->randomElement($products),
            'comment' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
            'is_flagged' => fake()->boolean(),
            'is_moderated' => fake()->boolean(),
            'status' => fake()->randomElement(['approved', 'rejected']),
        ];
    }
}
