<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PublisherSearchRequest;
use App\Http\Services\User\PublisherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PublisherController extends Controller
{
    /**
     * Constructor.
     *
     * @param PublisherService $publisherService
     */
    public function __construct(
        protected PublisherService $publisherService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(PublisherSearchRequest $request): JsonResponse
    {
        if ($publishers = $this->publisherService->getAllByPaginate($request->validated())) {
            return response()->json($publishers);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }
}
