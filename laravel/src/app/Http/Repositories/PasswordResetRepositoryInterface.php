<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

interface PasswordResetRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * The method get password reset token by email address and token
     *
     *
     * @param string $email
     *
     * @return ?Model
     */
    public function getPasswordResetToken(string $email): ?Model;

    /**
     * The method destroy the model by email address
     *
     * @param string $email
     *
     * @return bool
     */
    public function destroyByEmail(string $email): bool;
}
