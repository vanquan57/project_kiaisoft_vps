<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    /**
     * The constructor
     *
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        protected OrderRepositoryInterface $orderRepository
    ) {}

    /**
     * Get all orders by paginate
     *
     *  @param array $dataSearch
     * 
     * 
     * @return LengthAwarePaginator|null
     */
    public function getAllByPaginate(array $dataSearch): ?LengthAwarePaginator
    {
        try {
            $data = [
                'key_word' => $dataSearch['key_word'] ?? null,
                'start_date' => $dataSearch['start_date'] ?? null,
                'end_date' => $dataSearch['end_date'] ?? null,
                'status' => $dataSearch['status'] ?? null,
                'limit' => $dataSearch['limit']?? config('constants.DEFAULT_LIMIT'),
                'column' => $dataSearch['column']?? null,
                'order' => $dataSearch['order']?? null,
            ];

            return $this->orderRepository->getAllByPaginate($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Get details of the order
     *
     * @param int $id
     *
     * @return Order|null
     */
    public function show(int $id): ?Order
    {
        try {
            return $this->orderRepository->getDetails($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Update status book in order
     *
     * @param array $data
     *
     * @param int $id
     *
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        try {
            DB::beginTransaction();

            if (!$this->orderRepository->updateStatusBookInOrder($data, $id)) {
                throw new \Exception('Lỗi cập nhật trạng thái sách trong đơn mượn thất bại');
            }

            if (!$this->orderRepository->update($id, [
                'status' => $this->getOverallOrderStatus($id),
            ])) {
                throw new \Exception('Lỗi cập nhật trạng thái đơn mượn thất bại');
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
     * Get overall order status
     *
     * @param int $orderId
     *
     * @return int
     */
    private function getOverallOrderStatus(int $orderId): int
    {
        $statuses = $this->orderRepository->getOverallOrderStatus($orderId);

        // If order has only one book then return status of that book
        if ($statuses->count() === 1) {
            return $statuses->first();
        }

        // If order has only one overdue book then return overdue status
        if ($statuses->contains(OrderDetail::STATUS_OVERDUE)) {
            return Order::STATUS_OVERDUE;
        }

        // If order has only one missing book then return missing status
        if ($statuses->contains(OrderDetail::STATUS_MISSING)) {
            return Order::STATUS_MISSING;
        }

        // If order has only one borrowing book then return borrowing status
        if ($statuses->contains(OrderDetail::STATUS_BORROWING)) {
            return Order::STATUS_BORROWING;
        }

        return Order::STATUS_RETURNED;
    }
}
