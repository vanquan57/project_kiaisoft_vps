<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\FeedbackRepositoryInterface;
use App\Models\Feedback;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedbackRepository extends BaseRepository implements FeedbackRepositoryInterface
{
    /**
     * Get the model
     */
    public function getModel(): string
    {
        return Feedback::class;
    }

    /**
     * Get all feedbacks by paginate
     * 
     * @param array $data
     * 
     * @return LengthAwarePaginator|null
     */
    public function getAllByPaginate(array $data): ?LengthAwarePaginator
    {
        $query = $this->model->with([
            'user:id,name',
            'book:id,name',
        ]);

        if (isset($data['book_ids'])) {
            $query->whereIn('book_id', $data['book_ids']);

            if (!empty($data['start_date'])) {
                if (!empty($data['end_date'])) {
                    $query->whereBetween('created_at', [$data['start_date'], $data['end_date']]);
                }
    
                $query->whereBetween('created_at', [$data['start_date'], now()]);
            }    
        }

        if (!empty($data['column']) && !empty($data['order'])) {
            $query->orderBy($data['column'], $data['order']);
        }

        return $query->paginate($data['limit']);
    }

    /**
     * Update the feedback status
     *
     * @param int $id
     *
     * @return bool
     */
    public function updateStatus(int $id): bool
    {
        return $this->model->findOrFail($id)->update([
            'status' => Feedback::STATUS_ACTIVE,
        ]);
    }
}
