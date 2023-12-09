<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GeneralSetting>
 */
class GeneralSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "site_name" => fake()->company(),
            "tagline" => fake()->paragraph(),
            "favicon" => fake()->imageUrl(),
            "header_logo" => fake()->imageUrl(),
            "footer_logo" => fake()->imageUrl(),
            "company_phone" => fake()->phoneNumber(),
            "company_email" => fake()->email(),
            "address" => fake()->address(),
            "support_phone" => fake()->phoneNumber(),
            "support_email" => fake()->email(),
            "copyright" => fake()->company(),
            "facebook_url" => fake()->url(),
            "twitter_url" => fake()->url(),
            "instagram_url" => fake()->url(),
            "linked_in_url" => fake()->url(),
            "youtube_url" => fake()->url(),
        ];
    }
}
