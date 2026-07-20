<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimerApiController extends Controller
{
    public function index()
    {
        try {
            $timers = Timer::with(['user', 'pcExca'])->get();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
                'data' => $timers
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
            $timer = Timer::with([
                'user',
                'pcExca',
                'detailTimer',
                'haulerLog',
                'fillFactorTimer'
            ])->where('uuid', $uuid)->first();

            if (!$timer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data timer tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
                'data' => $timer
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
            $validator = Validator::make($request->all(), [
                'uuid' => 'required|string|unique:timers',
                'user_uuid' => 'required|string|exists:users,uuid',
                'pc_exca_uuid' => 'required|string|exists:pc_excas,uuid',

                // TIME
                'tgl' => 'required|date',
                'start_time' => 'required|date',
                'stop_time' => 'required|date',

                // GENERAL
                'job_site' => 'nullable|string',
                'user' => 'required|string',
                'fill_factor' => 'required|numeric',
                'hauler_quantity' => 'required|integer',

                // PCEXCA
                'pc_exca' => 'required|string',
                'model' => 'required|string',
                'ct_45' => 'required|numeric',
                'bucket_cap' => 'required|numeric',
                'swell_factor' => 'required|numeric',
                'density' => 'required|numeric',
                'direct_excavation' => 'required|boolean',
                'correction_factor' => 'required|numeric',

                // Total
                'total_cycle' => 'required|integer',
                'total_duration' => 'nullable|numeric',
                'total_ration' => 'nullable|numeric',
                'total_plan_sw45' => 'nullable|numeric',

                // Primary Work
                'primary_work_plan_sw45' => 'nullable|numeric',
                'primary_work_actual' => 'nullable|numeric',
                'primary_work_duration' => 'nullable|numeric',
                'primary_work_ration' => 'nullable|numeric',

                // Dig to Load
                'dig_to_load_plan_sw45' => 'nullable|numeric',
                'dig_to_load_actual' => 'nullable|numeric',
                'dig_to_load_duration' => 'nullable|numeric',
                'dig_to_load_ration' => 'nullable|numeric',

                // Swing Loaded
                'swing_loaded_plan_sw45' => 'nullable|numeric',
                'swing_loaded_actual' => 'nullable|numeric',
                'swing_loaded_duration' => 'nullable|numeric',
                'swing_loaded_ration' => 'nullable|numeric',

                // Dump
                'dump_plan_sw45' => 'nullable|numeric',
                'dump_actual' => 'nullable|numeric',
                'dump_duration' => 'nullable|numeric',
                'dump_ration' => 'nullable|numeric',

                // Swing Empty
                'swing_empty_plan_sw45' => 'nullable|numeric',
                'swing_empty_actual' => 'nullable|numeric',
                'swing_empty_duration' => 'nullable|numeric',
                'swing_empty_ration' => 'nullable|numeric',

                // Secondary Work
                'secondary_work_plan_sw45' => 'nullable|numeric',
                'secondary_work_actual' => 'nullable|numeric',
                'secondary_work_duration' => 'nullable|numeric',
                'secondary_work_ration' => 'nullable|numeric',

                // Clearing
                'clearing_plan_sw45' => 'nullable|numeric',
                'clearing_actual' => 'nullable|numeric',
                'clearing_duration' => 'nullable|numeric',
                'clearing_ration' => 'nullable|numeric',

                // Travel Position
                'travel_pos_plan_sw45' => 'nullable|numeric',
                'travel_pos_actual' => 'nullable|numeric',
                'travel_pos_duration' => 'nullable|numeric',
                'travel_pos_ration' => 'nullable|numeric',

                // Dig to Prepare
                'dig_to_prepare_plan_sw45' => 'nullable|numeric',
                'dig_to_prepare_actual' => 'nullable|numeric',
                'dig_to_prepare_duration' => 'nullable|numeric',
                'dig_to_prepare_ration' => 'nullable|numeric',

                // Wait to Dump
                'wait_to_dump_plan_sw45' => 'nullable|numeric',
                'wait_to_dump_actual' => 'nullable|numeric',
                'wait_to_dump_duration' => 'nullable|numeric',
                'wait_to_dump_ration' => 'nullable|numeric',

                // No Activity
                'no_activity_plan_sw45' => 'nullable|numeric',
                'no_activity_actual' => 'nullable|numeric',
                'no_activity_duration' => 'nullable|numeric',
                'no_activity_ration' => 'nullable|numeric',

                // Idle
                'idle_plan_sw45' => 'nullable|numeric',
                'idle_actual' => 'nullable|numeric',
                'idle_duration' => 'nullable|numeric',
                'idle_ration' => 'nullable|numeric',

                // Operator Change
                'operator_change_plan_sw45' => 'nullable|numeric',
                'operator_change_actual' => 'nullable|numeric',
                'operator_change_duration' => 'nullable|numeric',
                'operator_change_ration' => 'nullable|numeric',

                // Ex Change
                'ex_change_plan_sw45' => 'nullable|numeric',
                'ex_change_actual' => 'nullable|numeric',
                'ex_change_duration' => 'nullable|numeric',
                'ex_change_ration' => 'nullable|numeric',

                // Final Stats
                'average_passes' => 'nullable|numeric',
                'average_ct' => 'nullable|numeric',
                'production' => 'nullable|numeric',
                'productivity' => 'nullable|numeric',
                'fuel_consumption_liter' => 'nullable|numeric',
                'fuel_consumption_liter_hour' => 'nullable|numeric',
                'fuel_consumption_liter_bcm' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                    'errors' => $validator->errors()
                ], 422);
            }

            $timer = Timer::updateOrCreate(
                ['uuid' => $request->uuid],
                $request->all()
            );

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
                'data' => $timer
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => $error->getMessage(),
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $uuid)
    {
        try {
            $timer = Timer::where('uuid', $uuid)->first();

            if (!$timer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data timer tidak ditemukan.',
                ], 404);
            }

            $timer->update($request->only(array_keys($request->all())));

            return response()->json([
                'success' => true,
                'message' => 'Berhasil.',
                'data' => $timer
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
            $timer = Timer::where('uuid', $uuid)->first();
            if (!$timer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data timer tidak ditemukan.',
                ], 404);
            }

            $timer->delete();

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
