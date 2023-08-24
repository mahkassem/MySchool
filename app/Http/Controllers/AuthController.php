<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = $request->register();

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => $user,
        ], 201);
    }


    public function login(LoginRequest $request)
    {
        $auth = $request->login();

        return response()->json([
            'success' => true,
            'message' => 'User logged in successfully',
            'data' => $auth,
        ], 200);
    }
}
