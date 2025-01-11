<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\DistrictRepositoryInterface;
use App\Models\Author;
use App\Models\District;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel(): string
    {
        return District::class;
    }

    /**
     * Get all ward by district id
     *
     * @param int $districtId
     *
     * @return Collection
     */
    public function getWardByDistrictId(int $districtId): Collection
    {
        return $this->model->find($districtId)->wards;
    }
}
