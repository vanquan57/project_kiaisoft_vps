<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeedbackSearchRequest;
use App\Http\Services\FeedbackService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    /**
     * Constructor
     *
     * @param FeedbackService $feedbackService
     */
    public function __construct(protected FeedbackService $feedbackService) {}

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(FeedbackSearchRequest $request): JsonResponse
    {
        if($feedbacks = $this->feedbackService->getAllByPaginate($request->validated())) {
            return response()->json($feedbacks);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update status of the feedback
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(int $id): JsonResponse
    {
        if($this->feedbackService->update($id)){
            return response()->json(true);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the feedback
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if($this->feedbackService->destroy($id)){
            return response()->json(true);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }
}
