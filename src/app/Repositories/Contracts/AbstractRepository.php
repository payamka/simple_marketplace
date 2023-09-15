<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

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

    public function find($criteria, $eager = [])
    {
        return $this->getModel()->with($eager)->where($criteria);
    }

    public function delete(int $item_id, int|null $user_id = null): void
    {
        $item = $this->getModel()->where('id', $item_id);
        if($user_id != null)
            $item = $item->where('user_id', $user_id);

        $item->delete();
    }
}
