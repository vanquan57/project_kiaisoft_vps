<?php

namespace App\Http\Services\User;

use App\Http\Repositories\EmployeeCodeRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

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
     * @return array
     */
    public function register(array $data): array
    {
        try {
            if ($user = $this->userRepository->getRegisteredAccount($data['code'], $data['email'])) {
                if(!empty($user->google_id) && empty($user->password)) {
                    $this->userRepository->updateInfoWhenMappingAccountGoogle($user, $data);

                    return [
                        'message' => 'Đăng ký tài khoản thành công',
                        'code' => Response::HTTP_CREATED,
                    ];
                }else{
                    throw new \Exception('Tài khoản đã được đăng ký', Response::HTTP_BAD_REQUEST);
                }
            }

            // Using for unique email and code not using form request because has method register with google account
            if($this->userRepository->checkExistsAccountRegister($data['code'], $data['email'])) {
                throw new \Exception('Tài khoản đã được đăng ký', Response::HTTP_BAD_REQUEST);
            }

            if ($this->employeeCodeRepository->checkIsEmployeeKiaisoft($data['code'], $data['email'])) {
                $data['status'] = User::STATUS_ACTIVE;
            }

            if($this->userRepository->store($data)) {
                return [
                    'message' => 'Đăng ký tài khoản thành công',
                    'code' => Response::HTTP_CREATED,
                ];
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return [
                'error' => $e->getMessage(),
                'error_code' => match ($e->getCode()) {
                        Response::HTTP_BAD_REQUEST => ERROR_BAD_REQUEST,
                        default => ERROR_CODE_INTERNAL_SERVER_ERROR
                },
                'code' => $e->getCode(),
            ];
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
            $userGoogle = Socialite::driver('google')->userFromToken($data['access_token']);

            if (!$userGoogle) {
                return null;
            }

            $userRegistered = $this->userRepository->getRegisteredAccount($data['code'], $userGoogle->user['email']);

            // Check if the user has registered an account but not mapping with google id
            if ($userRegistered && empty($userRegistered->google_id)) {
                $this->userRepository->updateInfoWhenMappingAccountEmailPassword($userRegistered, $userGoogle->user['sub']);

                return $userRegistered;
            }

            // Check if the user has not registered an account
            if (!$userRegistered) {
                if (!$this->employeeCodeRepository->checkIsEmployeeKiaisoft($data['code'], $userGoogle->user['email'])) {
                    return null;
                }

                if (strpos($userGoogle->user['email'], 'kiaisoft') === false) {
                    return null;
                }

                return $this->userRepository->registerGoogle($data['code'], $userGoogle);
            }

            // Check if user registered with google account and mapping with google id
            if($userRegistered && $userRegistered->google_id == $userGoogle->user['sub']) {
                return $userRegistered;
            }

            return null;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }
}
