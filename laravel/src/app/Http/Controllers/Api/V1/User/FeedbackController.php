<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\FeedbackSearchRequest;
use App\Http\Requests\User\StoreFeedbackRequest;
use App\Http\Services\User\FeedbackService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    /**
     * The Constructor 
    */
    public function __construct(
        protected FeedbackService $feedbackService
    ){}

    /**
     * Get feedbacks by book id.
     * 
     * @param FeedbackSearchRequest $request
     * 
     * @return JsonResponse
     */
    public function getFeedbacksByBookId(FeedbackSearchRequest $request): JsonResponse
    {
        if($feedbacks = $this->feedbackService->getFeedbacksByBookId($request->validated())){
            return response()->json($feedbacks);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFeedbackRequest $request
     * 
     * @return JsonResponse
     */
    public function store(StoreFeedbackRequest $request): JsonResponse
    {
        $user = auth('api')->user();

        if(!$user){
            return response()->json(['error' => 'You are not unauthorized.'], Response::HTTP_UNAUTHORIZED);
        }

        if($feedback = $this->feedbackService->store($request->validated(), $user)){
            return response()->json($feedback, Response::HTTP_CREATED);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }
}
