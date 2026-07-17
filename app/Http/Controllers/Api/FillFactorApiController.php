<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FillFactor;
use Illuminate\Support\Facades\Validator;

class FillFactorApiController extends Controller
{
    public function index()
    {
        try {
            $data = FillFactor::all();

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
                'uuid' => 'required|string',
                'fill_factor' => 'required|numeric|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = FillFactor::updateOrCreate(
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
            $data = FillFactor::where('uuid', $uuid)->first();

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
            $fillFactor = FillFactor::where('uuid', $uuid)->first();

            if (!$fillFactor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'fill_factor' => 'required|numeric|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $fillFactor->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui data.',
                'data' => $fillFactor
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function destroy($uuid)
    {
        try {
            $fillFactor = FillFactor::where('uuid', $uuid)->first();

            if (!$fillFactor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $fillFactor->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data.',
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data.',
                'error' => $error->getMessage()
            ], 500);
        }
    }
}
