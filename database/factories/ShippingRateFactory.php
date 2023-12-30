<?php

namespace Database\Factories;

use App\Models\ShippingArea;
use App\Models\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingRate>
 */
class ShippingRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shippingAreas = ShippingArea::pluck('id')->toArray();
        $shippingMethods = ShippingMethod::pluck('id')->toArray();

        return [
            'shipping_area_id' => fake()->randomElement($shippingAreas),
            'shipping_method_id' => fake()->randomElement($shippingMethods),
            'min_order_total' => fake()->numberBetween(1, 5),
            'max_order_total' => fake()->numberBetween(10, 20),
            'rate' => fake()->numberBetween(100,800),
        ];
    }
}
