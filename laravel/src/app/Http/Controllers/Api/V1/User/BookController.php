<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\BookSearchRequest;
use App\Http\Requests\User\UpdateViewBookRequest;
use App\Http\Services\User\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
     /**
     * The constructor method
     *
     * @param BookService $bookService
     */
    public function __construct(
        protected BookService $bookService,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(BookSearchRequest $request): JsonResponse
    {
        if ($books = $this->bookService->getAllByPaginationForSiteUser($request->validated())) {
            return response()->json($books);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param int id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if ($book = $this->bookService->show($id)) {
            return response()->json($book);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updateBookViewCount(int $id): JsonResponse
    {
        if ($this->bookService->updateViewCount($id)) {
            return response()->json(true);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }

}
