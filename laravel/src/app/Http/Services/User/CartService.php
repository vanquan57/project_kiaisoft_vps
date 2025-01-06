<?php

namespace App\Http\Services\User;

use App\Http\Repositories\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService
{
    /**
     * The constructor
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository
    ) {}

    /**
     * Get book in my cart
     *
     * @return Collection|null
     */
    public function getBookInCartByUserId(): ?Collection
    {
        try {
            $user = auth('api')->user();

            if (!$user) {
                return null;
            }


            return $user->books()->get();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * 
     * @return bool
     */
    public function store(array $data): bool
    {
        try {
            $user = auth('api')->user();

            if (!$user) {
                return false;
            }

            DB::beginTransaction();

            $cartItems = $data['cart'] ?? [];

            foreach ($cartItems as $item) {
                $bookId = $item['book_id'] ?? null;
                $quantity = $item['quantity'] ?? null;

                if (!$bookId || !$quantity) {
                    continue;
                }

                $book = $this->bookRepository->find($bookId);

                // Check if the book exists, if the quantity is available, and if the user has not exceeded the quantity limit for the book
                if (
                    !$book ||
                    $book->quantity < $quantity ||
                    $user->books()->wherePivot('book_id', $bookId)->sum('carts.quantity') + $quantity > $book->quantity
                ) {
                    if (count($cartItems) === 1) {
                        return false;
                    }
                    continue;
                }

                $existingBook = $user->books()->wherePivot('book_id', $bookId)->first();
                // If the book already exists in the cart, add the quantity
                if ($existingBook) {
                    $newQuantity = $existingBook->pivot->quantity + $quantity;

                    $user->books()->updateExistingPivot($bookId, ['quantity' => $newQuantity]);
                } else {
                    $user->books()->attach($bookId, ['quantity' => $quantity]);
                }
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return false;
        }
    }


    /**
     * Update the specified wish list in storage
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function update(array $data): bool
    {
        try {
            $user = auth('api')->user();

            if (!$user) {
                return false;
            }

            $cartItems = $data['cart'] ?? [];

            foreach ($cartItems as $item) {
                $bookId = $item['book_id'] ?? null;
                $quantity = $item['quantity'] ?? null;

                if (!$bookId || !$quantity) {
                    continue;
                }

                $cart = $user->books()->wherePivot('book_id', $bookId)->first();

                if (!$cart) {
                    continue;
                }

                $book = $this->bookRepository->find($bookId);

                if (!$book || $book->quantity < $quantity) {
                    continue;
                }

                $user->books()->updateExistingPivot($bookId, ['quantity' => $quantity]);
            }

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }


    /**
     * Remove the specified wish list from storage
     * 
     * @param int $bookId
     * 
     * @return bool
     */
    public function destroy(int $bookId): bool
    {
        try {
            $user = auth('api')->user();

            if (!$user) {
                return false;
            }

            $cart = $user->books()->wherePivot('book_id', $bookId)->first();

            if (!$cart) {
                return false;
            }

            $user->books()->detach($bookId);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
