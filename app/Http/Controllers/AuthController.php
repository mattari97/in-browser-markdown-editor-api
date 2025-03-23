<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($user->email);

        return response()->json([
            'message' => 'Your account has been successfully created.',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token->plainTextToken,
            ],
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $token = $user->createToken($user->email);

        return response()->json([
            'message' => 'You are now logged in.',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token->plainTextToken,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'You have been logged out.',
        ]);
    }

    public function logoutFromAllSessions(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'You have been logged out from all devices.',
        ]);
    }
}
