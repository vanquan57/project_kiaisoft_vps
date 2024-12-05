<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUpdateAuthorRequest;
use App\Http\Requests\Admin\AuthorSearchRequest;
use App\Http\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Constructor
     *
     * @param AuthorService $authorService
     *
     */
    public function __construct(
        protected AuthorService $authorService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @param AuthorSearchRequest $request
     *
     * @return JsonResponse
     */
    public function index(AuthorSearchRequest $request): JsonResponse
    {
        if ($authors = $this->authorService->getAllByPaginate($request->validated())) {
            return response()->json($authors);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateAuthorRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreUpdateAuthorRequest $request): JsonResponse
    {
        if ($author = $this->authorService->store($request->validated())) {
            return response()->json($author, Response::HTTP_CREATED);
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
        if ($author = $this->authorService->show($id)) {
            return response()->json($author);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateAuthorRequest $request
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(StoreUpdateAuthorRequest $request, int $id): JsonResponse
    {
        if ($author = $this->authorService->update($id, $request->validated())) {
            return response()->json($author);
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
    public function destroy(int $id): JsonResponse
    {
        $result =  $this->authorService->destroy($id);

        if($result['code'] === Response::HTTP_OK) {
            return response()->json(['message' => $result['message']]);
        }

        return response()->json(['error' => $result['error']], $result['code']);
    }
}
