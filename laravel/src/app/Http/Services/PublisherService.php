<?php

namespace App\Http\Services;

use App\Http\Repositories\PublisherRepositoryInterface;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class PublisherService
{
    /**
     * Constructor.
     *
     * @param PublisherRepositoryInterface $publisherRepository
     */
    public function __construct(
        protected PublisherRepositoryInterface $publisherRepository
    ) {}

    /**
     * Get all publishers.
     *
     * @param array $dataSearch
     *
     * @return LengthAwarePaginator|null
     */
    public function getAllByPaginate(array $dataSearch): ?LengthAwarePaginator
    {
        try {
            $data = [
                'name' => $dataSearch['name'] ?? null,
                'limit' => $dataSearch['limit'] ?? config('constants.DEFAULT_LIMIT'),
                'order' => $dataSearch['order'] ?? null,
                'column' => $dataSearch['column'] ?? null,
            ];

            return $this->publisherRepository->getAllByPaginate($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     *
     * @return Publisher|null
     */
    public function store(array $data): ?Publisher
    {
        try {
            $data['slug'] = $data['name'];

            return $this->publisherRepository->store($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Publisher|null
     */
    public function show(int $id): ?Publisher
    {
        try {
            return $this->publisherRepository->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $data
     *
     * @param int $id
     *
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        try {
            $category = $this->publisherRepository->find($id);

            if (empty($category)) {
                return false;
            }

            $data['slug'] = $data['name'];

            return $this->publisherRepository->update($id, $data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return array
     */
    public function destroy(int $id): array
    {
        try {
            if ($this->publisherRepository->destroy($id)) {
                return [
                    'message' => 'The publisher has been deleted',
                    'code' => Response::HTTP_OK,
                ];
            }
            
            return [
                'error' => 'Publisher with registered books cannot be deleted',
                'code' => Response::HTTP_BAD_REQUEST,
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return [
                'error' => 'The request could not be processed.',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    }
}
