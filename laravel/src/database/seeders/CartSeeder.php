<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::create([
            'user_id' => 1,
            'book_id' => 1,
            'quantity' => 2,
        ]);

        Cart::create([
            'user_id' => 2,
            'book_id' => 2,
            'quantity' => 1,
        ]);
    }
}
