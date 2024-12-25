<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel(): string
    {
        return Order::class;
    }

    /**
     * Get all orders by paginate
     * 
     * @param array $data
     *
     * @return LengthAwarePaginator
     */
    public function getAllByPaginate($data): LengthAwarePaginator
    {
        $query = $this->model->query();

        if (!empty($data['key_word'])) {
            $query->where(function ($query) use ($data) {
                $query->whereHas('user', function ($query) use ($data) {
                    // Name of user
                    $query->where('name', 'like', '%' . $data['key_word'] . '%');
                })
                    // Or email of register in order
                    ->orWhere('email', 'like', '%' . $data['key_word'] . '%');
            });
        }

        if (!empty($data['start_date'])) {
            if (!empty($data['end_date'])) {
                $query->whereBetween('created_at', [$data['start_date'], $data['end_date']]);
            }

            $query->whereBetween('created_at', [$data['start_date'], now()]);
        }
        
        if (!empty($data['status'])) {
            $query->where('status', $data['status']);
        }

        if (!empty($data['column']) && !empty($data['order'])) {
            $query->orderBy($data['column'], $data['order']);
        }

        return $query->withCount('orderDetails')
            ->with('user:id,name,email')
            ->paginate($data['limit']);
    }

    /**
     * Get details of the order
     *
     * @param int $id
     *
     * @return Order|null
     */
    public function getDetails(int $id): ?Order
    {
        return $this->model->with([
            'user:id,name,email',
            'orderDetails',
        ])->find($id);
    }

    /**
     * Update status book in order
     *
     * @param array $data
     *
     * @param int $orderId
     *
     * @return bool
     */
    public function updateStatusBookInOrder(array $data, int $orderId): bool
    {
        $order = $this->model->findOrFail($orderId);
        $book = $order->orderDetails()->where('book_id', $data['book_id'])->first();

        if (!$book) {
            return false;
        }

        // If book is already returned, do not update status
        if ($book->pivot->status === OrderDetail::STATUS_RETURNED) {
            return false;
        }

        // If current order status is overdue, do not update status to borrowing
        if (
            $book->pivot->status === OrderDetail::STATUS_OVERDUE &&
            $data['status'] === OrderDetail::STATUS_BORROWING
        ) {
            return false;
        }

        // If book is missing, do not update status to other status except returned
        if ($book->pivot->status === OrderDetail::STATUS_MISSING && $data['status'] !== OrderDetail::STATUS_RETURNED) {
            return false;
        }

        // If book is missing, update with note
        if ($data['status'] === OrderDetail::STATUS_MISSING) {
            $book->pivot->status = OrderDetail::STATUS_MISSING;
            $book->pivot->note = $data['note'];

            return $book->pivot->save();
        }

        // If status is different current status, update status
        if ($book->pivot->status !== $data['status']) {
            $book->pivot->status = $data['status'];

            return $book->pivot->save();
        }

        return true;
    }

    /**
     * Get overall order status
     *
     * @param int $orderId
     *
     * @return Collection
     */
    public function getOverallOrderStatus(int $orderId): Collection
    {
        $order = $this->model->findOrFail($orderId);

        return $order->orderDetails->pluck('pivot.status');
    }
}
