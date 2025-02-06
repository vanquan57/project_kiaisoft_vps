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

    /**
     * Update info password when mapping account google
     * 
     * @param User $user
     * 
     * @param array $data
     * 
     * @return bool
    */
    public function updateInfoWhenMappingAccountGoogle(User $user, array $data): bool;

    /**
     * Update info when mapping account register with email password
     * 
     * @param User $user
     * 
     * @param string $googleId
     * 
     * @return bool
    */
    public function updateInfoWhenMappingAccountEmailPassword(User $user, string $googleId): bool;

    /**
     * Register google account information
     * 
     * @param string $code
     * 
     * @param object $userGoogle
     * 
     * @return Model
    */
    public function registerGoogle(string $code, object $userGoogle): Model;

    /**
     * Find the user with email
     *
     * @param string $email
     *
     * @return Model|null
     */
    public function findByEmail(string $email): ?Model;

    /**
     * Update password user
     *
     * @param int $userId
     * 
     * @param string $password
     *
     * @return bool
     */
    public function updatePassword(int $userId, string $password): bool;
}
