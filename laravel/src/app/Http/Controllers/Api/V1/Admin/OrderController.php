<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Http\Requests\Admin\OrderSearchRequest;
use App\Http\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * The constructor
     *
     * @param OrderService $orderService
     */
    public function __construct(
        protected OrderService $orderService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(OrderSearchRequest $request): JsonResponse
    {
        if ($orders = $this->orderService->getAllByPaginate($request->validated())) {
            return response()->json($orders);
        }

        return response()->json([
            'error' => 'The request could not be processed',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if ($order = $this->orderService->show($id)) {
            return response()->json($order);
        }

        return response()->json([
            'error' => 'The request could not be processed',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(UpdateOrderRequest $request, int $id): JsonResponse
    {
        if ($this->orderService->update($request->validated(), $id)) {
            return response()->json(true);
        }

        return response()->json([
            'error' => 'The request could not be processed',
        ], Response::HTTP_BAD_REQUEST);
    }
}
