<?php

namespace Database\Factories;

use App\Models\FaqSubcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FaqContent>
 */
class FaqContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faqSubcategory = FaqSubcategory::pluck("id")->toArray();

        return [
            'faq_subcategory_id' => fake()->randomElement($faqSubcategory),
            'question' => fake()->sentence(),
            'slug' => fake()->unique()->slug(),
            'answer' => fake()->paragraph(10),
            'created_at' => fake()->dateTimeBetween('-9 months', now()),
        ];
    }
}
