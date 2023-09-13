<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Services\User\iUserService;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __construct(private iUserService $user_service){}

    public function store(RegisterRequest $request)
    {
        $token = $this->user_service->create($request->validated());

        if($token)
            return $this->success(['token' => $token], 100, Response::HTTP_CREATED);
    }
}
