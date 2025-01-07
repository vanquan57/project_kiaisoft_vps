<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateOrderRequest;
use App\Http\Requests\User\OrderSearchRequest;
use App\Http\Requests\User\StoreOrderRequest;
use App\Http\Services\User\OrderService;
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
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        if ($order = $this->orderService->store($request->validated())) {
            return response()->json($order, Response::HTTP_CREATED);
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
            return response()->json([
                'message' => 'Update successfully',
            ]);
        }

        return response()->json([
            'error' => 'The request could not be processed',
        ], Response::HTTP_BAD_REQUEST);
    }
}
