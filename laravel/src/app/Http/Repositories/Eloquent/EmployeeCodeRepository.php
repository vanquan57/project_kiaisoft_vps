<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\EmployeeCodeRepositoryInterface;
use App\Models\EmployeeCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeCodeRepository extends BaseRepository implements EmployeeCodeRepositoryInterface
{
    public function getModel(): string
    {
        return EmployeeCode::class;
    }

    /**
     * Check is employee kiaisoft
     *
     * @param string $employeeCode
     * 
     * @param string $email
     *
     * @return bool
     */
    public function checkIsEmployeeKiaisoft(string $employeeCode, string $email): bool
    {
        return $this->model->where('code', $employeeCode)->where('email', $email)->exists();
    }

    /**
     * Get all employees code
     * 
     * @param array $data
     *
     * @return LengthAwarePaginator|null
     */
    public function getAllEmployeesCodes(array $data): LengthAwarePaginator
    {
        return $this->model->paginate($data['limit']);
    }

    /**
     * Create or update employee code
     *
     * @param array $data
     *
     * @return Model|null
     */
    public function updateOrCreate(array $data): ?Model
    {
        return $this->model->updateOrCreate(
            [
                'code' => $data['code'],
                'email' => $data['email'],
            ],
            [
                'code' => $data['code'],
                'email' => $data['email'],
                'name' => $data['name'],
            ]
        );
    }
}
