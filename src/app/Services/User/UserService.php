<?php

namespace App\Services\User;

use App\Repositories\User\iUserRepository;

class UserService implements iUserService
{

    public function __construct(private readonly iUserRepository $user_repo)
    {
    }

    public function create($input): string
    {
        $input['password'] = bcrypt($input['password']);
        return $this->user_repo->create($input)->createToken('authToken')->plainTextToken;
    }
}
