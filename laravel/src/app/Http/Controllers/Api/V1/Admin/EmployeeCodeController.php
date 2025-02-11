<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateEmployeeCodeRequest;
use App\Http\Requests\Admin\EmployeeSearchRequest;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
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
    public function index(EmployeeSearchRequest $request): JsonResponse
    {
        if (!$employees = $this->userService->getAllEmployeesCodes($request->validated())) {
            return responseErrorAPI(
                Response::HTTP_BAD_REQUEST,
                ERROR_BAD_REQUEST,
                'Không thể xử lý yêu cầu, vui lòng thử lại sau.'
            );
        }
        
        return responseOkAPI($employees);
    }

    /**
     * Store employee code
     *
     * @param CreateEmployeeCode $request
     * 
     * @return JsonResponse
     */
    public function store(CreateEmployeeCodeRequest $request): JsonResponse
    {
        if (!$this->userService->storeEmployeeCode($request->validated())) {
            return responseErrorAPI(
                Response::HTTP_BAD_REQUEST,
                ERROR_BAD_REQUEST,
                'Dữ liệu không hợp lệ, vui lòng kiểm tra lại'
            );
        }
        
        return responseOkAPI([
            'message' => 'Thêm thông tin nhân viên thành công'
        ]);
    }
}
