<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface DistrictRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Get all ward by district id
     *
     * @param int $districtId
     *
     * @return Collection
     */
    public function getWardByDistrictId(int $districtId): Collection;
}
