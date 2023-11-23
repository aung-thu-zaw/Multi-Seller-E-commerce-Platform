<?php

namespace Database\Factories;

use App\Models\BlogComment;
use App\Models\BlogContent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCommentReply>
 */
class BlogCommentReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $blogComments = BlogComment::pluck("id")->toArray();
        
        return [
            "blog_comment_id" => fake()->randomElement($blogComments),
            "user_id" => fake()->numberBetween(21, 30),
            "reply" => fake()->paragraph(),
        ];
    }
}
