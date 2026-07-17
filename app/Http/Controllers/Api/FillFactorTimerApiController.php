<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FillFactorTimer;
use Illuminate\Support\Facades\Validator;

class FillFactorTimerApiController extends Controller
{
    public function index()
    {
        try {
            $data = FillFactorTimer::with(['timer'])->get();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menampilkan data.',
                'data' => $data
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan data.',
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'uuid' => 'required|string|unique:fill_factor_timers',
                'cycle_number' => 'required|integer',
                'timer_uuid' => 'required|string|exists:timers,uuid',
                'fill_factor' => 'required|numeric|max:255',
                'created_at' => 'required|date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = FillFactorTimer::updateOrCreate(
                ['uuid' => $request->uuid],
                $request->all()
            );

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan.',
                'data' => $data
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data.',
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    public function show($uuid)
    {
        try {
            $data = FillFactorTimer::with(['timer'])->where('uuid', $uuid)->first();

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
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $uuid)
    {
        try {
            $detail = FillFactorTimer::where('uuid', $uuid)->first();

            if (!$detail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'timer_uuid' => 'required|string|exists:timers,id',
                'cycle_number' => 'required|integer',
                'fill_factor' => 'required|numeric|max:255',
                'created_at' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $detail->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
                'data' => $detail
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
            $detail = FillFactorTimer::where('uuid', $uuid)->first();

            if (!$detail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $detail->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.',
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
