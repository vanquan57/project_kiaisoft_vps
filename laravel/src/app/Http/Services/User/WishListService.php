<?php

namespace App\Http\Services\User;

use App\Http\Repositories\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class WishListService
{
    /**
     * The constructor
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository
    ) {}

    /**
     * Get all my wish list
     * 
     * @return Collection|null
     */
    public function getAll(): ?Collection
    {
        try {
            $user = auth('api')->user();

            if (!$user) {
                return null;
            }

            $books =  $user->wishLists()->with([
                'author:id,name',
                'publisher:id,name',
            ])->withCount('feedbacks')->get();

            foreach ($books as $book) {
                $book->average_star = $book->averageStar();
            }

            return $books;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Store a newly created wish list in storage
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
                return null;
            }

            $book = $this->bookRepository->find($data['book_id']);

            if (!$book) {
                return null;
            }

            if ($user->wishLists()->where('book_id', $data['book_id'])->exists()) {
                return false;
            }

            $user->wishLists()->attach($book->id);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
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

            $bookInWishList = $user->wishLists()->wherePivot('book_id', $bookId)->first();

            if (!$bookInWishList) {
                return false;
            }

            $user->wishLists()->detach($bookId);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
