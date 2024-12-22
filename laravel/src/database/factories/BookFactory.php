<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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

        $authorId = Author::all()->pluck('id')->toArray();
        $publisherId = Publisher::all()->pluck('id')->toArray();
        $name = $this->faker->unique()->name;

        return [
            'author_id' => $this->faker->randomElement($authorId),
            'publisher_id' => $this->faker->randomElement($publisherId),
            'name' => $name,
            'slug' => Str::slug($name),
            'mini_description' => $this->faker->sentence(10),
            'details_description' => $this->faker->text(200),
            'publication_date' => $this->faker->date(),
            'quantity' => $this->faker->numberBetween(1, 500),
            'size' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'page' => $this->faker->numberBetween(100, 1000),
            'cover_type' => $this->faker->numberBetween(1, 2),
            'views' => $this->faker->numberBetween(0, 100000),
            'borrowing_number' => $this->faker->numberBetween(0, 5000),
            'image' => $urls[$this->faker->numberBetween(0, 3)],
        ];
    }
}
