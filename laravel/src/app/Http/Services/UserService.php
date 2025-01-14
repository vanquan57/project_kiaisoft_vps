<?php

namespace App\Http\Services;

use App\Http\Repositories\EmployeeCodeRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
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

    /**
     * Public function get all employees codes
     * 
     * @param array $data
     *
     * @return LengthAwarePaginator|null
     */
    public function getAllEmployeesCodes(array $data): ?LengthAwarePaginator
    {
        try {
            $data = [
                'limit' => $data['limit'] ?? config('constants.DEFAULT_LIMIT'),
            ];

            return $this->employeeCodeRepository->getAllEmployeesCodes($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Public function store employee code
     *
     * @param array $data
     *
     * @return bool
     */
    public function storeEmployeeCode(array $data): bool
    {
        try {
            DB::beginTransaction();

            if (isset($data['file']) && $data['file']->isValid()) {
                $file = $data['file'];
                $handle = fopen($file->getRealPath(), 'r');
                $row = 0;
                $employeeCodes = [];

                while (($line = fgetcsv($handle, 1000, ',')) !== false) {
                    $row++;

                    if ($row === 1) {
                        continue;
                    }

                    if(empty($line[0]) || empty($line[1]) || empty($line[2])) {
                        continue;
                    }

                    if(count($line) > 3 || count($line) < 3){
                        return false;
                    }
                    // Check if code is not Kxxxxx or kiaisoft then skip
                    if (!preg_match('/^K\d{5}$/', $line[0]) && !str_contains($line[0], config('constants.FORMAT_EMAIL_EMPLOYEE'))) {
                        return false;
                    }
                    // Check if account is registered and active then skip
                    if($this->userRepository->checkAccountRegisteredAndActive($line[0], $line[1])){
                        continue;
                    }

                    $employeeCodes[] = [
                        'code' => $line[0],
                        'email' => $line[1],
                        'name' => $line[2],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                if (!empty($employeeCodes)) {
                    foreach ($employeeCodes as $employee) {
                        $this->employeeCodeRepository->updateOrCreate($employee);
                    }
                    DB::commit();
                    
                    return true;
                }

                return false;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();

            return false;
        }
    }
}
