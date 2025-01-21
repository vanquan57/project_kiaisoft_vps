<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateStatusUserRequest;
use App\Http\Requests\Admin\UserSearchRequest;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @param UserSearchRequest $request
     *
     * @return JsonResponse
     */
    public function index(UserSearchRequest $request): JsonResponse
    {
        if ($users = $this->userService->getAllByPagination($request->validated())) {
            return response()->json($users);
        }

        return response()->json([
            'error' => 'The request could not be processed',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStatusUserRequest $request
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(UpdateStatusUserRequest $request, int $id): JsonResponse
    {
        if ($this->userService->updateStatus($request->validated(), $id)) {
            return response()->json(true);
        }

        return response()->json([
            'error' => 'The request could not be processed',
        ], Response::HTTP_BAD_REQUEST);
    }
}
