<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUpdateCategoryRequest;
use App\Http\Requests\Admin\CategorySearchRequest;
use App\Http\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Constructor
     *
     * @param CategoryService $categoryService
     */
    public function __construct(
        protected CategoryService $categoryService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(CategorySearchRequest $request): JsonResponse
    {
        if ($categories = $this->categoryService->getAllByPagination($request->validated())) {
            return response()->json($categories);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreUpdateCategoryRequest $request): JsonResponse
    {
        if ($category = $this->categoryService->store($request->validated())) {
            return response()->json($category, Response::HTTP_CREATED);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
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
        if ($category = $this->categoryService->show($id)) {
            return response()->json($category);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(StoreUpdateCategoryRequest $request, int $id): JsonResponse
    {
        if ($this->categoryService->update($request->validated(), $id)) {
            return response()->json(['message' => 'Category updated successfully']);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $result = $this->categoryService->destroy($id);

        if($result['code'] >= 200 && $result['code'] < 300) {
            return response()->json(['message' => $result['message']], $result['code']);
        }

        return response()->json(['error' => $result['error']], $result['code']);
    }
}
