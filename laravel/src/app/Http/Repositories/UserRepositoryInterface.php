<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * Find the user with google id
     *
     * @param string $googleId
     *
     * @return User|null
     */
    public function findByGoogleId(string $googleId): ?User;

    /**
     * Get registered account
     *
     * @param string $employeeCode
     * 
     * @param string $email
     *
     * @return User|null
     */
    public function getRegisteredAccount(string $employeeCode, string $email): ?User;

    /**
     * Check exists account register
     * 
     * @param string $employeeCode
     * 
     * @param string $email
     * 
     * @return bool
    */
    public function checkExistsAccountRegister(string $employeeCode, string $email): bool;
}
