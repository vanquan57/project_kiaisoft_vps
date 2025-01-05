<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategorySearchRequest;
use App\Http\Services\User\CategoryService;
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
}
