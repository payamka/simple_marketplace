<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface iAbstractRepository
{
    public function create(array $attributes = []): Model;
    public function getOneById(int $id);
    public function find($criteria, $eager = []): Model|null;
    public function delete(int $item_id, int|null $user_id = null): void;
    public function list(int $count, array $eager = []): mixed;
}
