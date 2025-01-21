<?php

namespace App\Http\Repositories;

interface EmployeeCodeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Check is employee kiaisoft
     *
     * @param string $employeeCode
     * 
     * @param string $email
     *
     * @return bool
     */
    public function checkIsEmployeeKiaisoft(string $employeeCode, string $email): bool;
}
