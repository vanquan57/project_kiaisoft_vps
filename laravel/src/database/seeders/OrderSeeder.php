<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::all()->pluck('id')->toArray();
        $provinceIds = Province::all()->pluck('id')->toArray();
        $districtIds = District::all()->pluck('id')->toArray();
        $wardIds = Ward::all()->pluck('id')->toArray();

        // send data to OrderFactory
        Order::factory()->count(10)->withRandomData($userIds, $provinceIds, $districtIds, $wardIds)->create();

        $books = Book::all();

        $orderDetails = [];

        foreach (Order::all() as $order) {
            $booksForOrder = $books->random(rand(1, 3));
            $orderStatus = $order->status;

            //default borrow_date and return date
            $borrowDate = Carbon::now()->addDays($daysBorrowed = rand(1, 10));
            $returnDate = Carbon::now()->addDays($daysBorrowed)->addDays(rand(1, 5));

            // if order status is overdue
            if ($orderStatus == Order::STATUS_OVERDUE) {
                $borrowDate = Carbon::now()->subDays($daysBorrowed = rand(5, 10));
                $returnDate = Carbon::now()->subDays($daysBorrowed)->addDays(rand(1, 5));
            }

            foreach ($booksForOrder as $book) {
                $orderDetails[] = [
                    'order_id' => $order->id,
                    'book_id' => $book->id,
                    'borrow_date' => $borrowDate,
                    'return_date' => $returnDate,
                    'quantity' => rand(1, 3),
                    'note' => 'This is a note for testing.',
                    'status' => $orderStatus,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        OrderDetail::insert($orderDetails);
    }
}
