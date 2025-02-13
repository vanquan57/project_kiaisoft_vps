<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\OrderRepositoryInterface;
use App\Models\Book;
use App\Mail\OverdueBooksNotification;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Carbon\Carbon;
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
     * @return Model|null
     */
    public function getBookInOrder(array $data, int $orderId): ?Model
    {
        $order = $this->model->findOrFail($orderId);
        $book = $order->orderDetails()->where('book_id', $data['book_id'])->first();

        if (!$book) {
            return null;
        }

        return $book;
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

    /**
     * Update status book in order
     * 
     * @param Book $book
     * 
     * @param array $data
     * 
     * @return bool
    */
    public function updateStatusBookInOrder(Book $book, array $data): bool
    {
        if ($data['status'] == OrderDetail::STATUS_MISSING){
            $book->pivot->status = OrderDetail::STATUS_MISSING;
            $book->pivot->note = $data['note'];

            return $book->pivot->save();
        }

        $book->pivot->status = $data['status'];
        
        return $book->pivot->save();
    }

    /**
     * Get all order overdue
     *
     * @return Collection
     */
    public function getAllOrderOverdue(): Collection
    {
        return $this->model->where('status', '!=', Order::STATUS_RETURNED)
            ->with([
                'orderDetails' => function ($query) {
                    $query->where('status', '!=', OrderDetail::STATUS_RETURNED)
                        ->whereDate('return_date', '<', Carbon::now());
                }
            ])
            ->get();
    }

    /**
     * Update status multiple book in order
     * 
     * @param Order $order
     * 
     * @param array $overdueDetails
     * 
     * @return void
    */
    public function updateStatusMultipleBookOverdueInOrder(Order $order, array $overdueDetails ): void
    {
        $order->orderDetails()->syncWithoutDetaching(array_fill_keys($overdueDetails, [
            'status' => OrderDetail::STATUS_OVERDUE,
        ]));
    }

    /**
     * Update status multiple order is overdue
     * 
     * @param array $idsOrder
     * 
     * @return void
     */
    public function updateStatusMultipleOrderIsOverdue(array $idsOrder): void
    {
        $this->model->whereIn('id', $idsOrder)->update(['status' => Order::STATUS_OVERDUE]);
    }
}
