<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size' => fake()->randomElement(['L', 'XL', 'M', 'MMM', 'LML']),
            'color' => fake()->randomElement(['red', 'green', 'black', 'white', 'yellow']),
        ];
    }
}
