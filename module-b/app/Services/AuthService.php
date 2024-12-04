<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;

class AuthService
{
    public function register(string $name, string $password): array
    {
        $user = User::create([
            'name' => $name,
            'password' => Hash::make($password),
        ]);

        $token = $user->createToken('nomad')->accessToken;

        return [
            'user' => $user,
            'role' => 'User',
            'token' => $token
        ];
    }

    public function login(string $name, string $password): array
    {
        $role = 'user';
        if (Auth::attempt(['name' => $name, 'password' => $password])) {
            $user = Auth::user();

            $token = $user->createToken('nomad')->accessToken;

            if ($user->is_admin === 1) {
                $role = 'Admin';
            }

            return [
                'user' => $user->name,
                'role' => $role,
                'token' => $token
            ];
        }

        return [
            'message' => "user $name is unauthorized",
            'status' => 401
        ];
    }

    public function revokeToken(?Model $user): JsonResponse
    {
        $token = $user->token();

        if ($token instanceof Token) {
            $token->revoke();
            return response()->json([
                'message' => 'Successfully logged out',
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid token',
        ], 400);
    }

}
