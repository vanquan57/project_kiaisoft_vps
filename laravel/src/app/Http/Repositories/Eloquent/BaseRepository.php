<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $_model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get model
     *
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel(): void
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     */
    public function getAll(): Collection
    {
        return $this->_model->all();
    }

    /**
     * Find
     */
    public function find(int $id): Model
    {
        return $this->_model->find($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Model $model
     */
    public function store(array $attributes): Model
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->_model->find($id)->update($attributes);
    }

    /**
     * Delete
     */
    public function destroy(int $id): bool
    {
        return $this->_model->find($id)->delete();
    }
}
