<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateInfoRequest;
use App\Http\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * The constructor
     *
     * @param UserService $userService
     */
    public function __construct(protected UserService $userService) {}

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(): JsonResponse
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        if ($userDetails = $this->userService->show($user->id)) {
            return response()->json($userDetails, Response::HTTP_OK);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInfoRequest $request
     *
     * @return JsonResponse
     */
    public function update(UpdateInfoRequest $request): JsonResponse
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        if ($this->userService->update($request->validated(), $user->id)) {
            return response()->json(['message' => 'Update successfully'], Response::HTTP_OK);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }
}
