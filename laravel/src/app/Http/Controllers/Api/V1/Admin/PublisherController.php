<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUpdatePublisherRequest;
use App\Http\Requests\Admin\PublisherSearchRequest;
use App\Http\Services\PublisherService;
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

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreUpdatePublisherRequest $request
     * 
     * @return JsonResponse
     */
    public function store(StoreUpdatePublisherRequest $request): JsonResponse
    {
        if ($publisher = $this->publisherService->store($request->validated())) {
            return response()->json($publisher, Response::HTTP_CREATED);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
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
        if ($publisher = $this->publisherService->show($id)) {
            return response()->json($publisher);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdatePublisherRequest $request
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(StoreUpdatePublisherRequest $request, int $id): JsonResponse
    {
        if ($this->publisherService->update($id, $request->validated())) {
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
        $result = $this->publisherService->destroy($id);

        if($result['code'] >= 200 && $result['code'] < 300) {
            return response()->json(['message' => $result['message']], $result['code']);
        }

        return response()->json(['error' => $result['error']], $result['code']);
    }
}
