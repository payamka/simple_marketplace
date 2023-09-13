<?php

namespace App\Services\User;

use App\Repositories\User\iUserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService implements iUserService
{
    private iUserRepository $user_repo;

    public function __construct(iUserRepository $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    public function create($input): string
    {
        $input['password'] = bcrypt($input['password']);
        return $this->user_repo->create($input)->createToken('authToken')->plainTextToken;
    }
}
