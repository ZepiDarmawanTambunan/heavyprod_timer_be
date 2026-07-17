<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('username', $request->input('username'))->first();

            if(!$user){
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan.',
                    'data' => null
                ], 404);
            }

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60
                ],
            ], 200);

        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function me()
    {
        try {
            $user = User::where('id', auth('api')->id())->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data user berhasil diambil.',
                'data' => $user
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan data user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function refreshToken(){
        try {
            $currentToken = JWTAuth::getToken();

            if(!$currentToken){
                return response()->json([
                    'success' => false,
                    'message' => 'Token tidak ditemukan.',
                ], 404);
            }

            $newToken = JWTAuth::refresh($currentToken);

            return response()->json([
                'success' => true,
                'message' => 'Token berhasil diperbarui',
                'data' => [
                    'token' => $newToken,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60
                ],
            ], 200);

        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal refresh token !',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil.',
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal logout.',
                'error' => $error->getMessage()
            ], 500);
        }
    }
}
