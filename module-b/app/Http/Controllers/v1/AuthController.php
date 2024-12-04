<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $result = $this->authService->register($data['name'], $data['password']);

        return response()->json($result, 201);
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $result = $this->authService->login($data['name'], $data['password']);

        if (isset($result['status'])) {
            return response()->json($result, 401);
        }
        return response()->json($result, 200);
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->authService->revokeToken($request->user());
    }
}
