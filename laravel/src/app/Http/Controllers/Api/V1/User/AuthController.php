<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\User\RegisterGoogleRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Services\User\UserService;
use App\Models\User;
use Google_Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @param UserService $userService
     *
     * @return void
     */
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = User::ROLE_USER;
        $credentials['status'] = User::STATUS_ACTIVE;

        if (!$token = auth('api')->attempt($credentials)) {
            return responseErrorAPI(
                Response::HTTP_UNAUTHORIZED,
                ERROR_CODE_AUTHENTICATE,
                'Email hoặc mật khẩu không chính xác'
            );
        }

        return responseOkAPI($this->respondWithToken($token));
    }

    /**
     * register a newly created resource in storage.
     *
     * @param RegisterRequest $request
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->userService->register($request->validated());

        if ($result['code'] !== Response::HTTP_CREATED) {
            return responseErrorAPI(
                $result['code'],
                $result['error_code'],
                $result['error']
            );
        }

        return responseOkAPI(
            $result['message'],
            $result['code']
        );
    }

    /**
     * Function and register for google.
     *
     * @param RegisterGoogleRequest $request
     *
     * @return JsonResponse
     */
    public function registerGoogle(RegisterGoogleRequest $request): JsonResponse
    {
        if ($user = $this->userService->registerGoogle($request->validated())) {
            if (!$token = auth('api')->login($user)) {
                return responseErrorAPI(
                    Response::HTTP_UNAUTHORIZED,
                    ERROR_CODE_AUTHENTICATE,
                    'Bạn không có quyền truy cập vào trang web này'
                );
            }

            return responseOkAPI($this->respondWithToken($token));
        }

        return responseErrorAPI(
            Response::HTTP_BAD_REQUEST,
            ERROR_BAD_REQUEST,
            'Bạn không phải nhân viên kiaisoft ?. Vui lòng kiểm tra email và mã nhân viên'
        );
    }

    /**
     * The method login google
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loginGoogle(Request $request): JsonResponse
    {
        try {
            $userGoogle = Socialite::driver('google')->userFromToken($request->input('access_token'));

            if (!$userGoogle) {
                throw new \Exception('Không tìm thấy thông tin tài khoản. Vui lòng thử lại', Response::HTTP_UNAUTHORIZED);
            }

            $user = $this->userService->findByGoogleId($userGoogle->user['sub']);

            if (!$user) {
                throw new \Exception('Vui lòng đăng ký tài khoản trước khi đăng nhập.', Response::HTTP_UNAUTHORIZED);
            }

            if (!$token = auth('api')->login($user)) {
                throw new \Exception('Bạn không có quyền truy cập vào trang web này.', Response::HTTP_UNAUTHORIZED);
            }

            return responseOkAPI($this->respondWithToken($token));
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return responseErrorAPI(
                $e->getCode(),
                match ($e->getCode()) {
                    Response::HTTP_UNAUTHORIZED => ERROR_CODE_AUTHENTICATE,
                    default => ERROR_CODE_INTERNAL_SERVER_ERROR
                },
                $e->getMessage()
            );
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('api')->logout();
        auth('api')->invalidate(auth('api')->getToken());

        return responseOkAPI([
            'message' => 'Đăng xuất thành công.'
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return array
     */
    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ];
    }
}
