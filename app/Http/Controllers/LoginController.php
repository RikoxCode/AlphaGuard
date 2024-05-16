<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $userController;

    public function __construct()
    {
        $this->userController = new UserController();
    }


    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['token' => $token, 'user' => UserResource::make($user)];
    }

    public function register(StoreUserRequest $request)
    {
        $user = $this->userController->store($request)['data'];

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => UserResource::make($user)
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function getMe(Request $request)
    {
        return UserResource::make(auth()->user());
    }
}
