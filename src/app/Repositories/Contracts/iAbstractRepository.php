<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface iAbstractRepository
{
    public function create(array $attributes = []): Model;
    public function getOneById(int $id);
    public function delete(int $item_id, int|null $user_id = null): void;
}
