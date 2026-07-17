<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    protected function isAdmin()
    {
        return auth('api')->user()->hak_akses === 'admin';
    }

    public function index()
    {
        try {
            if (!$this->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized.',
                ], 403);
            }

            $users = User::all();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
                'data' => $users
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            if (!$this->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized.',
                ], 403);
            }

            $validator = Validator::make($request->all(), [
                'uuid' => 'required|string|unique:users',
                'username' => 'required|unique:users',
                'pin' => 'required',
                'hak_akses' => 'required|in:admin,user',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::updateOrCreate(
            ['uuid' => $request->uuid],
            [
                'username' => $request->username,
                'pin' => Hash::make($request->pin),
                'hak_akses' => $request->hak_akses,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
                'data' => $user
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function show($uuid)
    {
        try {
            if (!$this->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized.',
                ], 403);
            }

            $user = User::where('uuid', $uuid)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
                'data' => $user
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $uuid)
    {
        try {
            if (!$this->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized.',
                ], 403);
            }

            $user = User::where('uuid', $uuid)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'username' => 'required|unique:users,username,' . $user->id,
                'pin' => 'nullable',
                'hak_akses' => 'required|in:admin,user',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $updateData = $request->only(['username', 'hak_akses']);
            if ($request->filled('pin')) {
                $updateData['pin'] = Hash::make($request->pin);
            }
            $user->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
                'data' => $user
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function destroy($uuid)
    {
        try {
            if (!$this->isAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized.',
                ], 403);
            }

            $user = User::where('uuid', $uuid)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan.',
                ], 404);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal',
                'error' => $error->getMessage()
            ], 500);
        }
    }
}
