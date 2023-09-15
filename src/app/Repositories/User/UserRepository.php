<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Contracts\AbstractRepository;

class UserRepository extends AbstractRepository implements iUserRepository
{
    protected $model = User::class;
}
