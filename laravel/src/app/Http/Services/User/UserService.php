<?php

namespace App\Http\Services\User;

use App\Http\Repositories\EmployeeCodeRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class UserService
{
    /**
     * Constructor
     *
     * @param UserRepositoryInterface $userRepository
     * 
     * @param EmployeeCodeRepositoryInterface $employeeCodeRepository
     *
     * @return void
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected EmployeeCodeRepositoryInterface $employeeCodeRepository,
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

    /**
     * The create token request and send to email address
     *
     * @param array $data
     *
     * @return bool
     */
    public function sendEmail(array $data): bool
    {
        try {
            $user = $this->userRepository->findByEmail($data['email']);

            if (!$user) {
                return false;
            }

            $status = Password::sendResetLink([
                'email' => $data['email']
            ]);

            if ($status !== Password::ResetLinkSent) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * The method reset password
     *
     * @param array $data
     *
     * @return array
     */
    public function resetPassword(array $data): array
    {
        try {
            $status = Password::reset([
                'email' => $data['email'],
                'token' => $data['token'],
                'password' => $data['password'],
            ], function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $this->userRepository->commitChanges($user);
     
                event(new PasswordReset($user));
            });

            if ($status === Password::InvalidUser) {
                throw new \Exception('Không tìm thấy tài khoản của bạn.', Response::HTTP_NOT_FOUND);
            }

            if ($status === Password::InvalidToken){
                throw new \Exception('Token không đúng hoặc đã hết hạn vui lòng kiểm tra lại.', Response::HTTP_BAD_REQUEST);
            }

            if ($status !== Password::PasswordReset) {
                throw new \Exception('Có lỗi xảy ra vui lòng thử lại sau', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return [
                'message' => 'Đặt lại mật khẩu thành công',
                'code' => Response::HTTP_OK,
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return [
                'error' => $e->getMessage(),
                'error_code' => match ($e->getCode()) {
                        Response::HTTP_BAD_REQUEST => ERROR_BAD_REQUEST,
                        Response::HTTP_NOT_FOUND => ERROR_CODE_NOT_FOUND,
                        default => ERROR_CODE_INTERNAL_SERVER_ERROR
                },
                'code' => $e->getCode(),
            ];
        }
    }

    /**
     * The change password
     * 
     * @param array $data
     * 
     * @return array
     */
    public function changePassword(array $data): array
    {
        try {
            $user = auth('api')->user();

            if (!$user){
                throw new \Exception('Bạn không có quyền truy cập vào trang web này', Response::HTTP_UNAUTHORIZED);
            }
            
            if (!Hash::check($data['current_password'], $user->password)) {
                throw new \Exception('Mật khẩu hiện tại không chính xác', Response::HTTP_BAD_REQUEST);
            }

            if(!$this->userRepository->updatePassword($user->id, $data['password'])) {
                throw new \Exception('Có lỗi xảy ra, vui lòng thử lại sau.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return [
                'message' => 'Đổi mật khẩu thành công',
                'code' => Response::HTTP_OK,
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return [
                'error' => $e->getMessage(),
                'error_code' => match ($e->getCode()) {
                        Response::HTTP_BAD_REQUEST => ERROR_BAD_REQUEST,
                        Response::HTTP_UNAUTHORIZED => ERROR_CODE_AUTHENTICATE,
                        default => ERROR_CODE_INTERNAL_SERVER_ERROR
                },
                'code' => $e->getCode(),
            ];
        }
    }
}
