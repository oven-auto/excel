<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\User\AuthRepository;
use Illuminate\Http\Request;
use App\Http\Requests\User\AuthRegisterRequest;
use App\Http\Requests\User\AuthLoginRequest;

class AuthController extends Controller
{
    public function __construct(
        private AuthRepository $repo 
    )
    {

    }



    public function register(AuthRegisterRequest $request) 
    {
        $user = $this->repo->create(data: $request->validated());

        $token = $this->repo->getToken(user: $user);

        return response()->json([
            'success' => 1,
            'user' => $user,
            'token' => $token,
        ]);
    }



    public function login(AuthLoginRequest $request)
    {
        $user = $this->repo->login(data: $request->validated());

        $token = $this->repo->getToken(user: $user);

        return response()->json([
            'success' => 1,
            'user' => $user,
            'token' => $token,
        ]);
    }



    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => 1,
        ]);
    }
}
