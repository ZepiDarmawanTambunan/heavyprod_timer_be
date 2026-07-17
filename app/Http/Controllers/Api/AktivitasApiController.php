<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aktivitas;
use Illuminate\Support\Facades\Validator;

class AktivitasApiController extends Controller
{
    public function index()
    {
        try {
            $data = Aktivitas::all();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menampilkan data.',
                'data' => $data
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan data.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'uuid' => 'required|string|unique:aktivitas',
                'aktivitas' => 'required|string|max:255',
                'kategori' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = Aktivitas::updateOrCreate(
                ['uuid' => $request->uuid],
                $request->all()
            );

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menambahkan data.',
                'data' => $data
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function show($uuid)
    {
        try {
            $data = Aktivitas::where('uuid', $uuid)->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menampilkan data.',
                'data' => $data
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan data.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $uuid)
    {
        try {
            $aktivitas = Aktivitas::where('uuid', $uuid)->first();

            if (!$aktivitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'aktivitas' => 'required|string|max:255',
                'kategori' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $aktivitas->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui data.',
                'data' => $aktivitas
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data.',
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    public function destroy($uuid)
    {
        try {
            $aktivitas = Aktivitas::where('uuid', $uuid)->first();

            if (!$aktivitas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $aktivitas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data.',
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data.',
                'error' => $error->getMessage(),
            ], 500);
        }
    }
}
