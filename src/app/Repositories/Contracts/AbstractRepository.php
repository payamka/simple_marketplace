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
}
