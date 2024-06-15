<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Services\UserService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    use HttpResponses;
    private UserService $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function validateToken(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return $this->errors('Token not provided',401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken || $personalAccessToken->tokenable_type !== 'App\Models\User') {
            return $this->errors('Token is invalid or expired', 401);
        }

        return $this->success('Token is valid', 200);
    }
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return $this->success('Authorized', 200, [
                'token_type' => 'Bearer',
                'token' => $request->user()->createToken('auth_token')->plainTextToken
            ]);
        }

        return $this->errors('Not Authorized', 401);
    }

    public function register(Request $request)
    {
        return $this->userService->store($request->all());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success('Token Revoked', 200);
    }

    public function me()
    {
        return new UserResource(Auth::user());
    }
}
