<?php

namespace App\Http\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all users pagination
     *
     * @param array $data
     *
     * @return LengthAwarePaginator
     */
    public function getAllByPagination(
        array $data,
    ): LengthAwarePaginator;
}
