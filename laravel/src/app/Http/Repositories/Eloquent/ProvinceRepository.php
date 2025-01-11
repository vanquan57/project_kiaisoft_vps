<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\ProvinceRepositoryInterface;
use App\Models\Province;
use Illuminate\Database\Eloquent\Collection;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel(): string
    {
        return Province::class;
    }

    /**
     * Get all district by province id
     *
     * @param int $provinceId
     *
     * @return Collection
     */
    public function getDistrictByProvinceId(int $provinceId): Collection
    {
        return $this->model->find($provinceId)->districts;
    }

}
