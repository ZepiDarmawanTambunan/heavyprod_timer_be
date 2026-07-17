<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailTimer;
use Illuminate\Support\Facades\Validator;

class DetailTimerApiController extends Controller
{
    public function index()
    {
        try {
            $data = DetailTimer::with(['timer', 'aktivitas'])->get();

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
                'uuid' => 'required|string|unique:detail_timers',
                'timer_uuid' => 'required|string|exists:timers,uuid',
                'detik' => 'required|integer',
                'cycle_number' => 'required|integer',
                'aktivitas_uuid' => 'required|string|exists:aktivitas,uuid',
                'aktivitas' => 'required|string',
                'kategori_aktivitas' => 'required|string',
                'start_time' => 'required|date',
                'stop_time' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = DetailTimer::updateOrCreate(
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
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function show($uuid)
    {
        try {
            $data = DetailTimer::with(['timer', 'aktivitas'])->where('uuid', $uuid)->first();

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
            $detail = DetailTimer::where('uuid', $uuid)->first();

            if (!$detail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'timer_uuid' => 'required|string|exists:timers,uuid',
                'detik' => 'required|integer',
                'cycle_number' => 'required|integer',
                'aktivitas_uuid' => 'required|string|exists:aktivitas,uuid',
                'aktivitas' => 'required|string',
                'kategori_aktivitas' => 'required|string',
                'start_time' => 'required|date',
                'stop_time' => 'required|date',
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
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function destroy($uuid)
    {
        try {
            $detail = DetailTimer::where('uuid', $uuid)->first();

            if (!$detail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                    'data' => null
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
                'error' => $error->getMessage()
            ], 500);
        }
    }
}
