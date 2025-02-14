<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;
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

    /**
     * Check account is registered and active
     * 
     * @param string $code
     * 
     * @param string $email
     * 
     * @return bool
     */
    public function checkAccountRegisteredAndActive(
        string $code,
        string $email,
    );

    /**
     * Get top user most orders
     * 
     * @param array $data
     * 
     * @return Collection|null
     */
    public function getTopUsersMostOder(array $data): ?Collection;
}
