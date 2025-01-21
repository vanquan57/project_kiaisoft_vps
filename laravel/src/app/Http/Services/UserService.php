<?php

namespace App\Http\Services;

use App\Http\Repositories\EmployeeCodeRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * Constructor
     *
     * @param UserRepositoryInterface $userRepository
     *
     * @return void
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected EmployeeCodeRepositoryInterface $employeeCodeRepository
    ) {}

    /**
     * Public function get all users
     *
     * @param array $dataSearch
     *
     * @return LengthAwarePaginator|null
     */
    public function getAllByPagination(array $dataSearch): ?LengthAwarePaginator
    {
        try {
            $data = [
                'key_word' => $dataSearch['key_word'] ?? null,
                'limit' => $dataSearch['limit'] ?? config('constants.DEFAULT_LIMIT'),
                'column' => $dataSearch['column'] ?? null,
                'order' => $dataSearch['type'] ?? null,
            ];

            return $this->userRepository->getAllByPagination($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Public function update user
     *
     * @param array $data
     * 
     * @param int $id
     *
     * @return bool
     */
    public function updateStatus(array $data, int $id): bool
    {
        try {
            $user = $this->userRepository->find($id);

            if (!$user) {
                return false;
            }

            if ($user->status === $data['status']) {
                return false;
            }

            if ($data['status'] === User::STATUS_BLOCK) {
                return $this->userRepository->update($id, $data);
            }

            switch ($user->status) {
                case User::STATUS_WAITING:
                    if (
                        $data['status'] === User::STATUS_ACTIVE &&
                        $this->employeeCodeRepository->checkIsEmployeeKiaisoft($user->code, $user->email)
                    ) {
                        return $this->userRepository->update($id, $data);
                    }
                    break;

                case User::STATUS_ACTIVE:
                    if ($data['status'] === User::STATUS_WAITING) {
                        return $this->userRepository->update($id, $data);
                    }
                    break;

                case User::STATUS_BLOCK:
                    if ($data['status'] === User::STATUS_WAITING) {
                        return $this->userRepository->update($id, $data);
                    }
                    break;

                default:
                    return false;
            }

            return false;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
