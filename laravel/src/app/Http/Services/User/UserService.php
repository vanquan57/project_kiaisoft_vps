<?php

namespace App\Http\Services\User;

use App\Http\Repositories\EmployeeCodeRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use App\Models\User;
use Google_Client;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
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
     * Register a newly created resource in storage.
     *
     * @param array $data
     *
     * @return Model|null
     */
    public function register(array $data): ?Model
    {
        try {
            if ($user = $this->userRepository->getRegisteredAccount($data['code'], $data['email'])) {
                if(!empty($user->google_id) && empty($user->password)) {
                    $user->name = $data['name'];
                    $user->password = bcrypt($data['password']);
                    $user->save();

                    return $user;
                }else{
                    return null;
                }
            }
            // Using for unique email and code not using form request because has method register with google account
            if($this->userRepository->checkExistsAccountRegister($data['code'], $data['email'])) {
                return null;
            }

            if ($this->employeeCodeRepository->checkIsEmployeeKiaisoft($data['code'], $data['email'])) {
                $data['status'] = User::STATUS_ACTIVE;
            }

            return $this->userRepository->store($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Find the user with google id
     *
     * @param string $googleId
     *
     * @return Authenticatable|null
     */
    public function findByGoogleId(string $googleId): ?Authenticatable
    {
        try {
            return $this->userRepository->findByGoogleId($googleId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * The method register new google account
     *
     * @param array $data
     *
     * @return Authenticatable|null
     */
    public function registerGoogle(array $data): ?Authenticatable
    {
        try {
            $client = new Google_Client([
                'client_id' => config('services.google.client_id'),
            ]);

            $payload = $client->verifyIdToken($data['credential']);

            if (!$payload) {
                return null;
            }

            $userRegistered = $this->userRepository->getRegisteredAccount($data['code'], $payload['email']);
            // Check if the user has registered an account but not mapping with google id
            if ($userRegistered && empty($userRegistered->google_id)) {
                $userRegistered->google_id = $payload['sub'];
                $userRegistered->save();

                return $userRegistered;
            }
            // Check if the user has not registered an account
            if (!$userRegistered) {
                if (!$this->employeeCodeRepository->checkIsEmployeeKiaisoft($data['code'], $payload['email'])) {
                    return null;
                }

                if (strpos($payload['email'], 'kiaisoft') === false) {
                    return null;
                }

                $dataRegister['code'] = $data['code'];
                $dataRegister['email'] = $payload['email'];
                $dataRegister['name'] = $payload['name'];
                $dataRegister['status'] = User::STATUS_ACTIVE;
                $dataRegister['google_id'] = $payload['sub'];

                return $this->userRepository->store($dataRegister);
            }
            // Check if user registered with google account and mapping with google id
            if($userRegistered && $userRegistered->google_id == $payload['sub']) {
                return $userRegistered;
            }

            return null;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }
}
