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
                    $user->name = $data['name'];
                    $user->password = bcrypt($data['password']);
                    $user->save();

                    return [
                        'message' => 'Đăng ký tài khoản thành công',
                        'code' => Response::HTTP_CREATED,
                    ];
                }else{
                    return [
                        'error' => 'Tài khoản đã được đăng ký',
                        'error_code' => ERROR_BAD_REQUEST,
                        'code' => Response::HTTP_BAD_REQUEST,
                    ];
                }
            }

            // Using for unique email and code not using form request because has method register with google account
            if($this->userRepository->checkExistsAccountRegister($data['code'], $data['email'])) {
                return [
                    'error' => 'Tài khoản đã được đăng ký',
                    'error_code' => ERROR_BAD_REQUEST,
                    'code' => Response::HTTP_BAD_REQUEST,
                ];
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
                'error' => 'Không thể xử lý yêu cầu, vui lòng thử lại sau',
                'error_code' => ERROR_CODE_INTERNAL_SERVER_ERROR,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
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
                $userRegistered->google_id = $userGoogle->user['sub'];
                $userRegistered->save();

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

                $dataRegister['code'] = $data['code'];
                $dataRegister['email'] = $userGoogle->user['email'];
                $dataRegister['name'] = $userGoogle->user['name'];
                $dataRegister['status'] = User::STATUS_ACTIVE;
                $dataRegister['google_id'] = $userGoogle->user['sub'];

                return $this->userRepository->store($dataRegister);
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
