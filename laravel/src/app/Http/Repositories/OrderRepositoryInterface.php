<?php

namespace App\Http\Repositories;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all orders by paginate
     *
     *  @param array $data
     * 
     * @return LengthAwarePaginator
     */
    public function getAllByPaginate(array $data): LengthAwarePaginator;

    /**
     * Get details of the order
     *
     * @param int $id
     *
     * @return Order|null
     */
    public function getDetails(int $id): ?Order;

    /**
     * Update status book in order
     *
     * @param array $data
     *
     * @param int $orderId
     *
     * @return Model|null
     */
    public function getBookInOrder(array $data, int $orderId): ?Model;

    /**
     * Get overall order status
     *
     * @param int $orderId
     *
     * @return Collection
     */
    public function getOverallOrderStatus(int $orderId): Collection;

    /**
     * Update status book in order
     * 
     * @param Book $book
     * 
     * @param array $data
     * 
     * @return bool
    */
    public function updateStatusBookInOrder(Book $book, array $data): bool;

    /**
     * Get all order overdue
     *
     * @return Collection
     */
    public function getAllOrderOverdue(): Collection;

    /**
     * Update status multiple order is overdue
     * 
     * @param array $idsOrder
     * 
     * @return bool
     */
    public function updateStatusMultipleOrderIsOverdue(array $idsOrder): bool;

    /**
     * Get data total orders by month
     * 
     * @return array|null
     */
    public function getTotalOrdersByMonth(): ?array;
}
