<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => fake()->unique()->randomElement([
                'resource/img/img1.jpg',
                'resource/img/img2.jpg',
                'resource/img/img3.jpg',
                'resource/img/img4.jpg',
                'resource/img/img5.jpg',
                'resource/img/img6.jpg',
                'resource/img/img7.jpg',
                'resource/img/img8.jpg',
                'resource/img/img9.jpg',
                'resource/img/img10.jpg',
                'resource/img/img11.jpg',
                'resource/img/img12.jpg',
            ]),
        ];
    }
}
