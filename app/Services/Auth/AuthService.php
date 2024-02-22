<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthInterface 
{
    /**
     * Login attempt by user
     */
    public function login(array $data): JsonResponse
    {
 
        if (Auth::attempt($data)) {
            $user = User::where('email', $data['email'])->first();
            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'errors' => [
                    'email' => ['Неверный Email или пароль']
                ]
            ], 422);
        }
    }
}