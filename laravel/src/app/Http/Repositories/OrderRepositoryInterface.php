<?php

namespace App\Http\Repositories;

use App\Models\Order;
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
     * @return bool
     */
    public function updateStatusBookInOrder(array $data, int $orderId): bool;

    /**
     * Get overall order status
     *
     * @param int $orderId
     *
     * @return Collection
     */
    public function getOverallOrderStatus(int $orderId): Collection;
}
