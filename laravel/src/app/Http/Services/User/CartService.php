<?php

namespace App\Http\Services\User;

use App\Http\Repositories\BookRepositoryInterface;
use App\Http\Repositories\CartRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService
{
    /**
     * The constructor
     * 
     * @param BookRepositoryInterface $bookRepository
     * 
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository,
        protected UserRepositoryInterface $userRepository,
        protected CartRepositoryInterface $cartRepository
    ) {}

    /**
     * Get book in my cart
     *
     * @return Collection|null
     */
    public function getAllBookInCart(): ?Collection
    {
        try {
            $user = auth('api')->user();

            return $this->userRepository->getAllBookInCart($user);
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
     * @return array
     */
    public function store(array $data): array
    {
        try {
            DB::beginTransaction();

            $user = auth('api')->user();

            $cartItems = $data['cart'] ?? [];
            $bookIsAddedToCart = [];
            $bookIsNotAddedToCart = [];
            $bookIds = array_column($cartItems, 'book_id');
            $dataCartInsert = [];
            $dataCartUpdate = [];

            $books = $this->bookRepository->findManyByIds($bookIds)->keyBy('id');
            $userCartBooks = $this->userRepository->getAllBookInCart($user)->keyBy('id');

            foreach ($cartItems as $item) {
                $bookId = $item['book_id'] ?? null;
                $quantity = $item['quantity'] ?? null;

                if (!$bookId || !$quantity) {
                    continue;
                }

                $book = $books[$bookId] ?? null;

                if (!$book) {
                    if (count($cartItems) === 1) {
                        throw new \Exception('Sách không tồn tại.', Response::HTTP_BAD_REQUEST);
                    }

                    continue;
                }

                $existingBook = $userCartBooks[$bookId] ?? null;
                $currentQuantity = $existingBook ? $existingBook->pivot->quantity : 0;

                // Check if the book exists, if the quantity is available, and if the user has not exceeded the quantity limit for the book
                if (
                    $book->quantity < $quantity ||
                    $currentQuantity + $quantity > $book->quantity
                ) {
                    if (count($cartItems) === 1) {
                        throw new \Exception('Số lượng sách không đủ hoặc đã vượt quá số lượng cho phép.', Response::HTTP_BAD_REQUEST);
                    }

                    $bookIsNotAddedToCart[] = $book->name;

                    continue;
                }

                // If the book already exists in the cart, add the quantity
                if ($existingBook) {
                    $dataCartUpdate[] = [
                        'user_id' => $user->id,
                        'book_id' => $bookId,
                        'quantity' => $currentQuantity + $quantity,
                        'updated_at' => Carbon::now(),
                    ];
                } else {
                    $dataCartInsert[] = [
                        'user_id' => $user->id,
                        'book_id' => $bookId,
                        'quantity' => $quantity,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }

                $bookIsAddedToCart[] = $book->name;
            }

            if (empty($dataCartInsert) && empty($dataCartUpdate)) {
                throw new \Exception('Không có sách nào được thêm vào giỏ.', Response::HTTP_BAD_REQUEST);
            }

            if (!empty($dataCartInsert)) {
                if (!$this->cartRepository->upsert($dataCartInsert)) {
                    throw new \Exception('Có lỗi xảy ra vui lòng thử lại sau.', Response::HTTP_BAD_REQUEST);
                }
            }

            if (!empty($dataCartUpdate)) {
                if (!$this->cartRepository->upsert($dataCartUpdate)) {
                    throw new \Exception('Có lỗi xảy ra vui lòng thử lại sau.', Response::HTTP_BAD_REQUEST);
                }
            }

            DB::commit();

            return [
                'message' => [
                    'success' => (count($bookIsAddedToCart) ? 'Đã thêm sách: ' . implode(', ', $bookIsAddedToCart) . ', vào giỏ mượn.' : ''),
                    'error' => (count($bookIsNotAddedToCart) ? 'Không thể thêm sách: ' . implode(', ', $bookIsNotAddedToCart) . ', do đã hết số lượng' : '')
                ],
                'code' => Response::HTTP_CREATED,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return [
                'error' => $e->getMessage(),
                'error_code' => match ($e->getCode()) {
                    Response::HTTP_BAD_REQUEST => ERROR_BAD_REQUEST,
                    default => ERROR_CODE_INTERNAL_SERVER_ERROR
                },
                'code' => $e->getCode(),
            ];
        }
    }

    /**
     * Update the specified wish list in storage
     * 
     * @param array $data
     * 
     * @return array
     */
    public function update(array $data): array
    {
        try {
            DB::beginTransaction();

            $user = auth('api')->user();

            $cartItems = $data['cart'] ?? [];
            $bookInCartIsUpdated = [];
            $bookInCartCannotUpdate = [];
            $bookIds = array_column($cartItems, 'book_id');
            $dataCartUpdate = [];

            $books = $this->bookRepository->findManyByIds($bookIds)->keyBy('id');
            $userCartBooks = $this->userRepository->getAllBookInCart($user)->keyBy('id');

            foreach ($cartItems as $item) {
                $bookId = $item['book_id'] ?? null;
                $quantity = $item['quantity'] ?? null;

                if (!$bookId || !$quantity) {
                    continue;
                }

                $existingBook = $userCartBooks[$bookId] ?? null;

                if (!$existingBook) {
                    continue;
                }

                $book = $books[$bookId] ?? null;

                if (!$book) {
                    if (count($cartItems) === 1) {
                        throw new \Exception('Sách không tồn tại.', Response::HTTP_BAD_REQUEST);
                    }

                    continue;
                }

                if ($book->quantity < $quantity) {
                    if (count($cartItems) === 1) {
                        throw new \Exception('Số lượng sách không đủ hoặc đã vượt quá số lượng cho phép.', Response::HTTP_BAD_REQUEST);
                    }

                    $bookInCartCannotUpdate[] = $book->name;

                    continue;
                }

                $dataCartUpdate[] = [
                    'user_id' => $user->id,
                    'book_id' => $bookId,
                    'quantity' => $quantity,
                    'updated_at' => Carbon::now(),
                ];
                $bookInCartIsUpdated[] = $book->name;
            }

            if (!empty($dataCartUpdate)) {
                if (!$this->cartRepository->upsert($dataCartUpdate)) {
                    throw new \Exception('Có lỗi xảy ra vui lòng thử lại sau.', Response::HTTP_BAD_REQUEST);
                }
            } else {
                throw new \Exception('Không có sách nào được cập nhật.', Response::HTTP_BAD_REQUEST);
            }

            DB::commit();

            return [
                'message' => [
                    'success' => (count($bookInCartIsUpdated) ? 'Đã cập nhật sách: ' . implode(', ', $bookInCartIsUpdated) : ''),
                    'error' => (count($bookInCartCannotUpdate) ? 'Không thể cập nhật sách: ' . implode(', ', $bookInCartCannotUpdate) . '. Do đã hết số lượng' : '')
                ],
                'code' => Response::HTTP_OK,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return [
                'error' => $e->getMessage(),
                'error_code' => match ($e->getCode()) {
                    Response::HTTP_BAD_REQUEST => ERROR_BAD_REQUEST,
                    default => ERROR_CODE_INTERNAL_SERVER_ERROR
                },
                'code' => $e->getCode(),
            ];
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

            $bookInCart = $this->userRepository->getBookExitingInCart($user, $bookId);

            if (!$bookInCart) {
                return false;
            }

            if (!$this->userRepository->destroyBookInCart($user, $bookId)) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
