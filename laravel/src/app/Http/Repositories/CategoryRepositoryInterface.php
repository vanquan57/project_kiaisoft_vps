<?php

namespace App\Http\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get categories by paginate
     *
     * @param array $data
     *
     * @return LengthAwarePaginator
     */
    public function getAllByPagination(array $data): LengthAwarePaginator;
}
