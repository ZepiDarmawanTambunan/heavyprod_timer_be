<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PcExca;
use Illuminate\Support\Facades\Validator;

class PcExcaApiController extends Controller
{
    public function index()
    {
        try {
            $data = PcExca::all();

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
                'uuid' => 'required|string|unique:pc_excas',
                'pc_exca' => 'required|string|max:255',
                'swell_factor' => 'required|numeric|max:255',
                'ct_45' => 'required|numeric|max:255',
                'model' => 'required|string|max:255',
                'bucket_cap' => 'required|numeric|max:255',
                'fuel_consumption' => 'required|numeric|max:255',
                'density' => 'required|numeric|max:255',
                'direct_excavation' => 'required|boolean',

                'total_plan_sw45' => 'nullable|numeric',
                'primary_work_plan_sw45' => 'nullable|numeric',
                'dig_to_load_plan_sw45' => 'nullable|numeric',
                'swing_loaded_plan_sw45' => 'nullable|numeric',
                'dump_plan_sw45' => 'nullable|numeric',
                'swing_empty_plan_sw45' => 'nullable|numeric',
                'secondary_work_plan_sw45' => 'nullable|numeric',
                'clearing_plan_sw45' => 'nullable|numeric',
                'travel_pos_plan_sw45' => 'nullable|numeric',
                'dig_to_prepare_plan_sw45' => 'nullable|numeric',
                'wait_to_dump_plan_sw45' => 'nullable|numeric',
                'no_activity_plan_sw45' => 'nullable|numeric',
                'idle_plan_sw45' => 'nullable|numeric',
                'operator_change_plan_sw45' => 'nullable|numeric',
                'ex_change_plan_sw45' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = PcExca::updateOrCreate(
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
            $data = PcExca::where('uuid', $uuid)->first();

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
            $pcExca = PcExca::where('uuid', $uuid)->first();

            if (!$pcExca) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'pc_exca' => 'required|string|max:255',
                'swell_factor' => 'required|numeric',
                'ct_45' => 'required|numeric|max:255',
                'model' => 'required|string|max:255',
                'bucket_cap' => 'required|numeric|max:255',
                'fuel_consumption' => 'required|numeric|max:255',
                'density' => 'required|numeric|max:255',
                'direct_excavation' => 'required|boolean',

                'total_plan_sw45' => 'nullable|numeric',
                'primary_work_plan_sw45' => 'nullable|numeric',
                'dig_to_load_plan_sw45' => 'nullable|numeric',
                'swing_loaded_plan_sw45' => 'nullable|numeric',
                'dump_plan_sw45' => 'nullable|numeric',
                'swing_empty_plan_sw45' => 'nullable|numeric',
                'secondary_work_plan_sw45' => 'nullable|numeric',
                'clearing_plan_sw45' => 'nullable|numeric',
                'travel_pos_plan_sw45' => 'nullable|numeric',
                'dig_to_prepare_plan_sw45' => 'nullable|numeric',
                'wait_to_dump_plan_sw45' => 'nullable|numeric',
                'no_activity_plan_sw45' => 'nullable|numeric',
                'idle_plan_sw45' => 'nullable|numeric',
                'operator_change_plan_sw45' => 'nullable|numeric',
                'ex_change_plan_sw45' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $pcExca->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
                'data' => $pcExca
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
            $pcExca = PcExca::where('uuid', $uuid)->first();

            if (!$pcExca) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            $pcExca->delete();

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
