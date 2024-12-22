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
        $urls = [
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9jzKNZw84mH-K18T17Kxx8Ai6sHlXl5viBQ&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbXCpiYKfm11YUjU715AE4xto0XO6fzBiL8Q&s',
            'https://newshop.vn/public/uploads/products/58518/2-mau-tai-loc-lich-treo-tuong-laminate-trang-guong-2025-40x60-cm_L.jpg',
            'https://newshop.vn/public/uploads/products/58662/200-bi-an-thu-vi-ve-vu-tru_L.jpg',

        ];

        return [
            'book_id' => $this->faker->numberBetween(1, 10),
            'url' => $urls[$this->faker->numberBetween(0, 4)],

        ];
    }
}
