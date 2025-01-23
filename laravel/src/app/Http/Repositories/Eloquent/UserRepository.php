<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel(): string
    {
        return User::class;
    }

    /**
     * Get all users pagination
     *
     * @param array $data
     *
     * @return LengthAwarePaginator
     */
    public function getAllByPagination(array $data): LengthAwarePaginator
    {
        $query = $this->model->query()->with([
            'district:id,name',
            'province:id,name',
            'ward:id,name',
        ])->where('role', User::ROLE_USER);

        if (!empty($data['key_word'])) {
            $query->where(function ($query) use ($data) {
                $query->where('code', 'like', '%' . $data['key_word'] . '%')
                    ->orWhere('email', 'like', '%' . $data['key_word'] . '%')
                    ->orWhere('name', 'like', '%' . $data['key_word'] . '%');
            });
        }

        if (!empty($data['column']) && !empty($data['order'])) {
            $query->orderBy($data['column'], $data['order']);
        }

        return $query->paginate($data['limit']);
    }

    /**
     * Check account is registered and active
     * 
     * @param string $code
     * 
     * @param string $email
     * 
     * @return bool
     */
    public function checkAccountRegisteredAndActive(string $code, string $email)
    {
        return $this->model->where('email', $email)
            ->where('code', $code)
            ->where('status', User::STATUS_ACTIVE)
            ->exists();
    }
}
