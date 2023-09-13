<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface iAbstractRepository
{
    public function create(array $attributes = []): Model;
}
