<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->email(),
            'status' => fake()->randomElement(['subscribed', 'unsubscribed']),
            'created_at' => fake()->dateTimeBetween('-4 months', now()),
        ];
    }
}
