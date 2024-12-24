<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookSearchRequest;
use App\Http\Requests\Admin\StoreBookRequest;
use App\Http\Requests\Admin\UpdateBookRequest;
use App\Http\Services\BookService;
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
        if ($books = $this->bookService->getAllByPagination($request->validated())) {
            return response()->json($books);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        if ($book = $this->bookService->store($request->validated())) {
            return response()->json($book, Response::HTTP_CREATED);
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
     * @param UpdateBookRequest $request
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        if ($this->bookService->update($request->validated(), $id)) {
            return response()->json(true);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $result = $this->bookService->destroy($id);

        if($result['code'] >= 200 && $result['code'] < 300) {
            return response()->json(['message' => $result['message']], $result['code']);
        }

        return response()->json(['error' => $result['error']], $result['code']);
    }
}
