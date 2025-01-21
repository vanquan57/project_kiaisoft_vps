<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\EmployeeCodeRepositoryInterface;
use App\Models\EmployeeCode;

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
}
