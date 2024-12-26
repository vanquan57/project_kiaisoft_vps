<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Facades\Log;

class BatchService
{
    /**
     * Constructor
     *
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        protected OrderRepositoryInterface $orderRepository
    ) {}

    /**
     * Progress check and update order status
     *
     * @return void
     */
    public function progressCheckAndUpdateOrderStatus()
    {
        try {
            $this->orderRepository->progressCheckAndUpdateOrderStatus();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
