<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        $loginSuccess = auth()->attempt($request->all());
        if (!$loginSuccess) {
            return response()->json([
                'message' => 'Kredensial tidak valid'
            ]);
        }

        $token = auth()->user()->createToken('api');

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}
