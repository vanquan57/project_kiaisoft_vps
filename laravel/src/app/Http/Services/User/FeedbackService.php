<?php

namespace App\Http\Services\User;

use App\Http\Repositories\BookRepositoryInterface;
use App\Http\Repositories\FeedbackRepositoryInterface;
use App\Models\Book;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class FeedbackService
{
    /**
     * Constructor
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository,
        protected FeedbackRepositoryInterface $feedbackRepository
    ) {}


    /**
     * Get feedbacks by book id.
     *
     * @param array $dataSearch
     * 
     * @return LengthAwarePaginator|null
     */
    public function getFeedbacksByBookId(array $dataSearch): ?LengthAwarePaginator
    {
        try {
            if (empty($dataSearch['book_id'])) {
                return null;
            }

            $book = $this->bookRepository->find($dataSearch['book_id']);

            if (!$book) {
                return null;
            }

            $data = [
                'limit' => $dataSearch['limit'] ?? config('constants.DEFAULT_LIMIT'),
                'column' => $dataSearch['column'] ?? null,
                'order' => $dataSearch['order'] ?? null,
            ];

            return $this->feedbackRepository->getFeedbacksByBookId($book, $data);
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
     * @param User $user
     * 
     * @return bool
     */
    public function store(array $data, User $user): bool
    {
        try {
            $book = $this->bookRepository->find($data['book_id']);

            if (!$book) {
                return false;
            }

            $user->feedbacks()->attach($book->id, [
                'content' => $data['content'],
                'star' => $data['star'],
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
