<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductQuestion>
 */
class ProductQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::where('status', 'active')->pluck('id')->toArray();
        $products = Product::where('status', 'approved')->pluck('id')->toArray();

        return [
            'user_id' => fake()->randomElement($users),
            'product_id' => fake()->randomElement($products),
            'question' => fake()->paragraph(),
        ];
    }
}
