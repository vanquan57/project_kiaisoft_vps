<?php

namespace App\Http\Services;

use App\Http\Repositories\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class AuthorService
{
    /**
     * Constructor
     *
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    /**
     * Get all
     *
     * @param array $dataSearch
     *
     * @return LengthAwarePaginator
     */
    public function getAllByPaginate(array $dataSearch): LengthAwarePaginator
    {
        try {
            $data = [
                'name' => $dataSearch['name'] ?? null,
                'limit' => $dataSearch['limit'] ?? config('constants.DEFAULT_LIMIT'),
                'order' => $dataSearch['order'] ?? null,
                'column' => $dataSearch['column'] ?? null,
            ];

            return $this->authorRepository->getAllByPaginate($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $attributes
     *
     * @return Author|null
     */
    public function store(array $attributes): ?Author
    {
        try {
            $attributes['slug'] = $attributes['name'];

            return $this->authorRepository->store($attributes);
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
     * @return Author|null
     */
    public function show(int $id): ?Author
    {
        try {
            return $this->authorRepository->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @param array $attributes
     *
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        try {
            $category = $this->authorRepository->find($id);

            if (!$category) {
                return false;
            }

            $attributes['slug'] = $attributes['name'];

            return $this->authorRepository->update($id, $attributes);
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
            if ($this->authorRepository->destroy($id)) {
                return [
                    'message' => 'The author has been deleted',
                    'code' => Response::HTTP_OK,
                ];
            }

            return [
                'error' => 'Author with registered books cannot be deleted',
                'code' => Response::HTTP_BAD_REQUEST,
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return [
                'error' => 'The request could not be processed',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    }
}
