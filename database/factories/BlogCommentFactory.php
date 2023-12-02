<?php

namespace Database\Factories;

use App\Models\BlogContent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogComment>
 */
class BlogCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'blog_content_id' => fake()->numberBetween(20, 50),
            'user_id' => fake()->numberBetween(5, 20),
            'comment' => fake()->paragraph(),
            'created_at' => fake()->dateTimeBetween('-2 months', now()),
        ];
    }
}
