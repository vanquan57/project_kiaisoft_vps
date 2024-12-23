<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all('id');
        $categories = Category::pluck('id');

        $bookCategoryData = [];

        foreach ($books as $book) {
            $randomCategories = $categories->random(rand(1, 3));

            foreach ($randomCategories as $categoryId) {
                $bookCategoryData[] = [
                    'book_id' => $book->id,
                    'category_id' => $categoryId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        BookCategory::insert($bookCategoryData);
    }
}
