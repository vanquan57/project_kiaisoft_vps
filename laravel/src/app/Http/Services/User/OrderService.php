<?php

namespace App\Http\Services\User;

use App\Http\Repositories\BookRepositoryInterface;
use App\Http\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderService
{
    /**
     * The constructor
     *
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected BookRepositoryInterface $bookRepository
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
        $user = auth('api')->user();

        if (!$user) {
            return null;
        }

        try {
            $data = [
                'user_id' => $user->id,
                'start_date' => $dataSearch['start_date'] ?? null,
                'end_date' => $dataSearch['end_date'] ?? null,
                'status' => $dataSearch['status'] ?? null,
                'limit' => $dataSearch['limit'] ?? config('constants.DEFAULT_LIMIT'),
                'column' => $dataSearch['column'] ?? null,
                'order' => $dataSearch['order']?? null,
            ];

            return $this->orderRepository->getAllByPaginate($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Store a new order
     *
     * @param array $data
     *
     * @return Model|null
     */
    public function store(array $data): ?Model
    {
        try {
            DB::beginTransaction();

            $user = auth('api')->user();

            if (!$user) {
                DB::rollBack();
                return null;
            }

            $data['user_id'] = $user->id;
            $currentCount = $this->orderRepository->countOrders();
            $nextNumber = $currentCount + 1;
            
            if ($nextNumber > 99999) {
                $orderCode = 'HD' . $nextNumber;
            }else{
                $orderCode = 'HD' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
            }

            $data['code'] = $orderCode;
            $data['status'] = Order::STATUS_BORROWING;
            $orderDetails = $data['order_details'];
            unset($data['order_details']);

            $order = $this->orderRepository->store($data);

            if (
                $order &&
                $orderDetails &&
                $this->bookRepository->checkQuantityForMultipleBooks($orderDetails)
            ) {
                if($this->orderRepository->addBookToOrder($order, $orderDetails)){
                    $this->bookRepository->updateQualityForMultipleBooks($orderDetails);

                    DB::commit();

                    return $order;
                }
            }

            DB::rollBack();

            return null;
        } catch (\Exception $e) {
            DB::rollBack();

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
            $user = auth('api')->user();

            if (!$user) {
                return null;
            }

            $orderDetails =  $this->orderRepository->getDetails($id);

            if (!$orderDetails || $orderDetails->user_id !== $user->id) {
                return null;
            }

            return $orderDetails;
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
                throw new \Exception('Server error please try again later');
            }

            if (!$this->updateOrderStatus($id, $this->getOverallOrderStatus($id))) {
                throw new \Exception('Server error please try again later');
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
        return $this->orderRepository->getOverallOrderStatus($orderId);
    }

    /**
     * Update status order
     *
     * @param int $orderId,
     * 
     * @param int $orderStatus
     *
     * @return bool
     */
    private function updateOrderStatus(int $orderId, int $orderStatus): bool
    {
        try {
            return $this->orderRepository->updateOrderStatus($orderId, $orderStatus);
        } catch (\Exception $e) {
            return false;
        }
    }
}
