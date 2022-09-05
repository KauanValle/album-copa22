<?php

namespace App\Http\Controllers;

use App\Http\Service\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new AuthService();
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        $token = $this->service->logarNaApi($credentials);

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

}
