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
            return response()->json(
                [
                    'error' => 'Unauthorized',
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->respondWithToken($token);
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
        if ($user = $this->userService->register($request->validated())) {
            return response()->json($user, Response::HTTP_CREATED);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
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
                return response()->json(
                    [
                        'error' => 'Unauthorized',
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            }

            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'The request could not be processed.'], Response::HTTP_BAD_REQUEST);
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
        $client = new Google_Client([
            'client_id' => config('services.google.client_id'),
        ]);

        $payload = $client->verifyIdToken($request->input('credential'));

        if (!$payload) {
            return response()->json(
                [
                    'error' => 'Unauthorized',
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = $this->userService->findByGoogleId($payload['sub']);

        if (!$user) {
            return response()->json(
                [
                    'error' => 'Unauthorized',
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        if (!$token = auth('api')->login($user)) {
            return response()->json(
                [
                    'error' => 'Unauthorized',
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->respondWithToken($token);
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

        return response()->json(
            [
                'message' => 'Successfully logged out',
            ]
        );
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
