<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

        // Create feedback for each user and book
        foreach ($users as $user) {
            foreach ($books as $book) {
                Feedback::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Donec auctor orci vel neque semper, in fermentum odio ultricies. Nullam tincidunt, risus in posuere gravida, arcu justo pulvinar orci, non placerat velit metus a justo.',
                    'star' => rand(1, 5),
                    'status' => rand(0, 1),
                ]);
            }
        }
    }
}
