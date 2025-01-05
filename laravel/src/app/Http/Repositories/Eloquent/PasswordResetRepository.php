<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\PasswordResetRepositoryInterface;
use App\Models\PasswordResetToken;
use Illuminate\Database\Eloquent\Model;

class PasswordResetRepository extends BaseRepository implements PasswordResetRepositoryInterface
{
    public function getModel(): string
    {
        return PasswordResetToken::class;
    }

    /**
     *
     * The method get password reset token by email address and token
     *
     * @param string $email
     *
     *
     * @return ?Model
     */
    public function getPasswordResetToken(string $email): ?Model
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * The method destroy the model by email address
     *
     * @param string $email
     *
     * @return bool
     */
    public function destroyByEmail(string $email): bool
    {
        return $this->model->where('email', $email)->delete();
    }
}
