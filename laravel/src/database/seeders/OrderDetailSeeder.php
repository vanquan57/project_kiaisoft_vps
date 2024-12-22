<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->count(10)
            ->create();

        $orders = Order::all();
        $bookIds = Book::all()->pluck('id')->toArray();

        foreach ($orders as $order) {
            $booksForOrder = array_rand($bookIds, rand(1, 2));

            if (!is_array($booksForOrder)) {
                $booksForOrder = [$booksForOrder];
            }

            foreach ($booksForOrder as $key) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'book_id' => $bookIds[$key],
                    'borrow_date' => Carbon::now()->subDays(rand(1, 30)),
                    'return_date' => Carbon::now()->addDays(rand(1, 15)),
                    'quantity' => rand(1, 3),
                    'note' => 'This is a note for testing.',
                    'status' => rand(1, 4),
                ]);
            }
        }
    }
}
