<?php

use App\Http\Controllers\Api\AktivitasApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DetailTimerApiController;
use App\Http\Controllers\Api\FillFactorApiController;
use App\Http\Controllers\Api\FillFactorTimerApiController;
use App\Http\Controllers\Api\HasilTimerApiController;
use App\Http\Controllers\Api\HaulerLogApiController;
use App\Http\Controllers\Api\PcExcaApiController;
use App\Http\Controllers\Api\TimerApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json([
        'status' => true,
        'message' => 'ping',
    ], 200);
});

Route::post('/login', [AuthApiController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthApiController::class, 'me']);
    Route::post('/refresh', [AuthApiController::class, 'refreshToken']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
});


Route::middleware(['auth:api'])->prefix('users')->group(function () {
    Route::get('', [UserApiController::class, 'index']);
    Route::post('', [UserApiController::class, 'store']);
    Route::get('/{uuid}', [UserApiController::class, 'show']);
    Route::put('/{uuid}', [UserApiController::class, 'update']);
    Route::delete('/{uuid}', [UserApiController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('timer')->group(function () {
    Route::get('/', [TimerApiController::class, 'index']);           // List semua timer
    Route::post('/', [TimerApiController::class, 'store']);          // Simpan timer baru
    Route::get('/{uuid}', [TimerApiController::class, 'show']);      // Tampilkan detail timer + relasi
    Route::put('/{uuid}', [TimerApiController::class, 'update']);    // Update beberapa field (active, user_uuid, pc_exca_uuid, job_site)
    Route::delete('/{uuid}', [TimerApiController::class, 'destroy']); // Hapus timer
});

Route::middleware('auth:api')->prefix('pc-exca')->group(function () {
    Route::get('/', [PcExcaApiController::class, 'index']);
    Route::post('/', [PcExcaApiController::class, 'store']);
    Route::get('/{uuid}', [PcExcaApiController::class, 'show']);
    Route::put('/{uuid}', [PcExcaApiController::class, 'update']);
    Route::delete('/{uuid}', [PcExcaApiController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('aktivitas')->group(function () {
    Route::get('/', [AktivitasApiController::class, 'index']);
    Route::post('/', [AktivitasApiController::class, 'store']);
    Route::get('/{uuid}', [AktivitasApiController::class, 'show']);
    Route::put('/{uuid}', [AktivitasApiController::class, 'update']);
    Route::delete('/{uuid}', [AktivitasApiController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('detail-timer')->group(function () {
    Route::get('/', [DetailTimerApiController::class, 'index']);
    Route::post('/', [DetailTimerApiController::class, 'store']);
    Route::get('/{uuid}', [DetailTimerApiController::class, 'show']);
    Route::put('/{uuid}', [DetailTimerApiController::class, 'update']);
    Route::delete('/{uuid}', [DetailTimerApiController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('fill-factor')->group(function () {
    Route::get('/', [FillFactorApiController::class, 'index']);
    Route::post('/', [FillFactorApiController::class, 'store']);
    Route::get('/{uuid}', [FillFactorApiController::class, 'show']);
    Route::put('/{uuid}', [FillFactorApiController::class, 'update']);
    Route::delete('/{uuid}', [FillFactorApiController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('fill-factor-timer')->group(function () {
    Route::get('/', [FillFactorTimerApiController::class, 'index']);
    Route::post('/', [FillFactorTimerApiController::class, 'store']);
    Route::get('/{uuid}', [FillFactorTimerApiController::class, 'show']);
    Route::put('/{uuid}', [FillFactorTimerApiController::class, 'update']);
    Route::delete('/{uuid}', [FillFactorTimerApiController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('hauler-log')->group(function () {
    Route::get('/', [HaulerLogApiController::class, 'index']);
    Route::post('/', [HaulerLogApiController::class, 'store']);
    Route::get('/{uuid}', [HaulerLogApiController::class, 'show']);
    Route::put('/{uuid}', [HaulerLogApiController::class, 'update']);
    Route::delete('/{uuid}', [HaulerLogApiController::class, 'destroy']);
});
