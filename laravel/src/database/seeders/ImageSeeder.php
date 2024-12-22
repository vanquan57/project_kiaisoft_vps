<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $urls = [
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9jzKNZw84mH-K18T17Kxx8Ai6sHlXl5viBQ&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbXCpiYKfm11YUjU715AE4xto0XO6fzBiL8Q&s',
            'https://newshop.vn/public/uploads/products/58518/2-mau-tai-loc-lich-treo-tuong-laminate-trang-guong-2025-40x60-cm_L.jpg',
            'https://newshop.vn/public/uploads/products/58662/200-bi-an-thu-vi-ve-vu-tru_L.jpg',

        ];
        $books = Book::all();

        foreach ($books as $book) {
            for ($i = 1; $i <= 4; $i++) {
                $randomIndex = array_rand($urls);

                $book->images()->create([
                    'url' => $urls[$randomIndex],
                ]);
            }
        }
    }
}
