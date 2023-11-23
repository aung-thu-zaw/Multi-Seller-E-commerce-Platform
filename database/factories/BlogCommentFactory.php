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
        $blogContent = BlogContent::where("status", "published")->pluck("id")->toArray();

        return [
            "blog_content_id" => fake()->randomElement($blogContent),
            "user_id" => fake()->numberBetween(5, 20),
            "comment" => fake()->paragraph(),
        ];
    }
}
