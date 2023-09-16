<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AbstractRepository implements iAbstractRepository
{
    protected $model;

    protected function getModel(): object
    {
        return new $this->model;
    }

    public function create(array $attributes = []): Model
    {
        return $this->getModel()->create($attributes);
    }

    public function getOneById(int $id)
    {
        return $this->getModel()->find($id);
    }

    public function findAllPaginate($criteria, $count, $sort_by = null, $eager = []): mixed
    {
        $list = $this->findByCriteria($criteria, $eager);
        if ($sort_by)
            $list = $list->orderBy($sort_by, 'asc');

        return $list->paginate($count);
    }

    public function find($criteria, $eager = []): Model|null
    {
        return $this->findByCriteria($criteria, $eager)->first();
    }

    public function delete(int $item_id, int|null $user_id = null): void
    {
        $item = $this->getModel()->where('id', $item_id);
        if ($user_id != null)
            $item = $item->where('user_id', $user_id);

        $item->delete();
    }

    private function findByCriteria($criteria, $eager = []): Builder
    {
        $list = $this->getModel()->with($eager);
        if (count($criteria) > 0)
            $list = $list->where($criteria);

        return $list;
    }
}
