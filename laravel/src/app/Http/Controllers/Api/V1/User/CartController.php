<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUpdateCartRequest;
use App\Http\Services\User\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CartController extends Controller
{
    /**
     * The constructor
     */
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Get book in my cart
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if ($bookInCart = $this->cartService->getBookInCartByUserId()) {
            return response()->json($bookInCart);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCartRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreUpdateCartRequest $request): JsonResponse
    {
        if ($cart = $this->cartService->store($request->all())) {
            return response()->json($cart);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCartRequest $request
     * 
     * @return JsonResponse
     */
    public function update(StoreUpdateCartRequest $request): JsonResponse
    {
        if ($this->cartService->update($request->validated())) {
            return response()->json(true);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $bookId
     *
     * @return JsonResponse
     */
    public function destroy(int $bookId): JsonResponse
    {
        if ($this->cartService->destroy($bookId)) {
            return response()->json(true);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }
}
