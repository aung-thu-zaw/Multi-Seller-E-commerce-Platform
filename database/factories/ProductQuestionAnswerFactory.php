<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductQuestionAnswer>
 */
class ProductQuestionAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_question_id' => fake()->numberBetween(1, 20),
            'store_id' => fake()->numberBetween(1, 2),
            'answer' => fake()->paragraph(),
        ];
    }
}
