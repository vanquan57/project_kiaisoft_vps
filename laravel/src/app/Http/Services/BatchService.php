<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderRepositoryInterface;
use App\Mail\OverdueBooksNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            $orders = $this->orderRepository->getAllOrderOverdue();

            $idsOrder = [];

            foreach ($orders as $order) {
                $overdueDetails = $order->orderDetails->pluck('id')->toArray();
                $overdueBooks = [];
    
                foreach ($order->orderDetails as $detail) {
                    $overdueBooks[] = $detail;
                }
    
                if (!empty($overdueDetails)) {
                    $this->orderRepository->updateStatusMultipleBookOverdueInOrder($order, $overdueDetails);
                   
                    $idsOrder[] = $order->id;
    
                    Mail::to($order->email)->send(new OverdueBooksNotification($order, $overdueBooks));
                }
            }
    
            if (!empty($idsOrder)) {
                $this->orderRepository->updateStatusMultipleOrderIsOverdue($idsOrder);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
