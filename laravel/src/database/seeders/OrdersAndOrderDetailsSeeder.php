<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrdersAndOrderDetailsSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->count(10)->create();

        $books = Book::all();

        $orderDetails = [];


        foreach (Order::all() as $order) {

            $booksForOrder = $books->random(rand(1, 3));

            foreach ($booksForOrder as $book) {
                $orderDetails[] = [
                    'order_id' => $order->id,
                    'book_id' => $book->id,
                    'borrow_date' => Carbon::now()->addDays($daysBorrowed = rand(1, 10)),
                    'return_date' => Carbon::now()->addDays($daysBorrowed)->addDays(rand(1, 5)),
                    'quantity' => rand(1, 3),
                    'note' => 'This is a note for testing.',
                    'status' => OrderDetail::STATUS_BORROWING,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        OrderDetail::insert($orderDetails);
    }
}
