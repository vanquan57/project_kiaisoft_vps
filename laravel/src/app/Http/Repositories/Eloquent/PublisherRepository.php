<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\PublisherRepositoryInterface;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PublisherRepository extends BaseRepository implements PublisherRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Publisher::class;
    }

    /**
     * Get all publishers by paginate.
     *
     * @param array $data
     * 
     * @return LengthAwarePaginator
     */
    public function getAllByPaginate(array $data): LengthAwarePaginator
    {
        $query = $this->model->query();

        if (!empty($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        if(!empty($data['column']) && !empty($data['order'])) {
            $query->orderBy($data['column'], $data['order']);
        }

        return $query->paginate($data['limit']);
    }

    /**
     * Destroy a publisher.
     *
     * @param int $id
     *
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $publisher = $this->model->find($id);

        if ($publisher->books->isEmpty()) {
            return $this->model->destroy($id);
        }

        return false;
    }
}
