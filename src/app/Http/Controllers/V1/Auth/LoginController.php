<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Test\TestFacades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyAuthApp')->plainTextToken;

            return $this->success([
                'user' => $user,
                'token' => $token
            ], self::$RESPONSE_OK, Response::HTTP_OK);
        } else {
            return $this->error(null, self::$RESPONSE_FAIL, Response::HTTP_UNAUTHORIZED);
        }
    }
}
