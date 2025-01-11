<?php

namespace App\Http\Services\User;

use App\Http\Repositories\DistrictRepositoryInterface;
use App\Http\Repositories\ProvinceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class LocationService
{
    /**
     * Constructor
     *
     * @param ProvinceRepositoryInterface $provinceRepository
     * 
     * @param DistrictRepositoryInterface $districtRepository
     */
    public function __construct(
        protected ProvinceRepositoryInterface $provinceRepository,
        protected DistrictRepositoryInterface $districtRepository,
        
    ) {}

    /**
     * Get all provinces
     *
     * @return Collection|null
     */
    public function getAllProvinces(): ?Collection
    {
        try {
            return $this->provinceRepository->getAll();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Get all districts by province id
     *
     * @param int $provinceId
     *
     * @return Collection|null
     */
    public function getDistrictsByProvinceId(int $provinceId): ?Collection
    {
        try {
            return $this->provinceRepository->getDistrictByProvinceId($provinceId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Get all wards by district id
     *
     * @param int $districtId
     *
     * @return Collection
     */
    public function getWardsByDistrictId(int $districtId): Collection
    {
        try {
            return $this->districtRepository->getWardByDistrictId($districtId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return collect();
        }
    }
}
