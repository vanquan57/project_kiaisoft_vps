<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;
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
    
        $books = Book::pluck('id');
        $imagesData = [];
    
        foreach ($books as $bookId) {
            $randomUrls = array_map(fn() => $urls[array_rand($urls)], range(1, 4));
    
            foreach ($randomUrls as $url) {
                $imagesData[] = [
                    'book_id' => $bookId,
                    'url' => $url,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Image::insert($imagesData);
    }
}
