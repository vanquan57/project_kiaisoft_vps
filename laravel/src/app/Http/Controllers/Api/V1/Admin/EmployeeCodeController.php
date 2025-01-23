<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateEmployeeCodeRequest;
use App\Http\Requests\Admin\EmployeeSearchRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeCodeController extends Controller
{
    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Get all employees information
     *
     * @param EmployeeSearchRequest $request
     * 
     * @return JsonResponse
     */
    public function index(EmployeeSearchRequest $request)
    {
        if ($employees = $this->userService->getAllEmployeesCodes($request->validated())) {
            return response()->json($employees);
        }

        return response()->json([
            'error' => 'The request could not be processed',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Store employee code
     *
     * @param CreateEmployeeCode $request
     * 
     * @return JsonResponse
     */
    public function store(CreateEmployeeCodeRequest $request)
    {
        if ($this->userService->storeEmployeeCode($request->validated())) {
            return response()->json(true);
        }

        return response()->json([
            'error' => 'The request could not be processed',
        ], Response::HTTP_BAD_REQUEST);
    }

}
