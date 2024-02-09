<?php

namespace Database\Factories;

use App\Models\ProductQuestion;
use App\Models\Store;
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
        $productQuestions = ProductQuestion::pluck('id')->toArray();
        $stores = Store::where('status', 'active')->pluck('id')->toArray();

        return [
            'product_question_id' => fake()->randomElement($productQuestions),
            'store_id' => fake()->randomElement($stores),
            'answer' => fake()->paragraph(),
        ];
    }
}
