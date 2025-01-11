<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ProvinceRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Get all district by province id
     *
     * @param int $provinceId
     *
     * @return Collection
     */
    public function getDistrictByProvinceId(int $provinceId): Collection;
}
