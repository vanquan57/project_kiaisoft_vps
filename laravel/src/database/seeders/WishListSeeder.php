<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WishListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $users = User::all();

        $wishListsData = [];

        foreach ($books as $book) {
            $randomUsers = $users->random(rand(1, 3));

            foreach ($randomUsers as $user) {
                $wishListsData[] = [
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        WishList::insert($wishListsData);
    }
}
