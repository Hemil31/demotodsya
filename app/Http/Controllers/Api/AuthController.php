<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user || $user->role == 2) {
                return $this->error('Invalid credentials.', [], 401);
            }
            if ($user->status == 0) {
                return $this->error('Your account is inactive. Please contact support.', [], 403);
            }
            if (!Hash::check($request->password, $user->password)) {
                return $this->error('Invalid credentials.', [], 401);
            }

            $user->tokens->each(function ($token) {
                $token->delete();
            });
            $token = $user->createToken('my-app-token')->plainTextToken;
            $user->makeHidden(['tokens']);

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return $this->success($response, 'Login successful');

        } catch (\Throwable $e) {
            \Log::error('Login Error: ' . $e->getMessage());
            return response()->json(['error' => 'Login failed.'], 500);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            $response = [
                'message' => 'Logged out successfully'
            ];
            return $this->success($response, 'Logout successful');
        } catch (\Throwable $e) {
            \Log::error('Logout Error: ' . $e->getMessage());
            return $this->error('Logout failed.', [], 500);
        }

    }
}




