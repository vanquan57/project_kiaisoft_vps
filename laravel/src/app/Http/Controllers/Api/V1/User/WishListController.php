<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreWishListRequest;
use App\Http\Services\User\WishListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class WishListController extends Controller
{
    /**
     * The constructor
     * 
     * @param WishListService $wishListService
    */
    public function __construct(protected WishListService $wishListService){}

    /**
     * Display a listing my wish list.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if($wishlists = $this->wishListService->getAll()){
            return response()->json($wishlists);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created wish list in storage.
     * 
     * @param StoreWishListRequest $request
     * 
     * @return JsonResponse
     */
    public function store(StoreWishListRequest $request): JsonResponse
    {
        if($wishList = $this->wishListService->store($request->validated())){
            return response()->json($wishList , Response::HTTP_CREATED);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified wish list from storage.
     * 
     * @param int $bookId
     * 
     * @return JsonResponse
     */
    public function destroy(int $bookId): JsonResponse
    {
        if($this->wishListService->destroy($bookId)){
            return response()->json(true, Response::HTTP_OK);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }
}
