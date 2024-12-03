<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel(): string
    {
        return User::class;
    }
}
