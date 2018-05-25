<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 15:19
 */

namespace App\Api\V1\Controllers\Auth;


use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['username', 'password']);
        if (!$token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('admin')->user());
    }

    public function logout()
    {
        auth('admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('admin')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ]);
    }
}