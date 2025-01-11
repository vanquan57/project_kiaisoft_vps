<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\LocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    public function __construct(
        protected LocationService $locationService
    ) {}


    /**
     * Get all provinces
     *
     * @return Collection|null
     */
    public function getAllProvinces(): JsonResponse
    {
        if ($provinces = $this->locationService->getAllProvinces()) {
            return response()->json($provinces);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Get all districts by province id
     *
     * @param int $provinceId
     *
     * @return Collection|null
     */
    public function getDistrictsByProvinceId(int $provinceId): JsonResponse
    {
        if ($districts = $this->locationService->getDistrictsByProvinceId($provinceId)) {
            return response()->json($districts);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Get all wards by district id
     *
     * @param int $districtId
     *
     * @return Collection|null
     */
    public function getWardsByDistrictId(int $districtId): JsonResponse
    {
        if ($wards = $this->locationService->getWardsByDistrictId($districtId)) {
            return response()->json($wards);
        }

        return response()->json(['error' => 'The request could not be processed'], Response::HTTP_BAD_REQUEST);
    }
}
