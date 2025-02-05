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
            return $this->responseOkAPI($categories);
        }

        return $this->responseErrorAPI(
            Response::HTTP_BAD_REQUEST,
            Response::HTTP_BAD_REQUEST,
            'Không thể xử lý yêu cầu, vui lòng thử lại sau.'
        );
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
            return $this->responseOkAPI($category, Response::HTTP_CREATED);
        }

        return $this->responseErrorAPI(
            Response::HTTP_BAD_REQUEST,
            Response::HTTP_BAD_REQUEST,
            'Không thể xử lý yêu cầu, vui lòng thử lại sau.'
        );
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
            return $this->responseOkAPI($category);
        }

        return $this->responseErrorAPI(
            Response::HTTP_NOT_FOUND,
            Response::HTTP_NOT_FOUND,
            'Danh mục không tồn tại.'
        );
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
            return $this->responseOkAPI([
                'message' => 'Cập nhật danh mục thành công.'
            ]);
        }

        return $this->responseErrorAPI(
            Response::HTTP_BAD_REQUEST,
            Response::HTTP_BAD_REQUEST,
            'Không thể xử lý yêu cầu, vui lòng thử lại sau.'
        );
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

        if ($result['code'] == Response::HTTP_OK) {
            return $this->responseOkAPI([
                'message' => $result['message']
            ]);
        }

        return $this->responseErrorAPI(
            $result['code'],
            $result['code'],
            $result['error']
        );
    }
}
