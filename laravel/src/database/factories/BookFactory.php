<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
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
            'sach1.jpg',
            'sach2.jpg',
            'sach3.jpg',
            'sach4.jpg',
        ];

        $name = $this->faker->unique()->name;

        return [
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

    public function withRandomData($authorIds, $publisherIds)
    {
        return $this->state(function (array $attributes) use ($authorIds, $publisherIds) {
            return [
                'author_id' => Arr::random($authorIds),
                'publisher_id' => Arr::random($publisherIds),
            ];
        });
    }
}
