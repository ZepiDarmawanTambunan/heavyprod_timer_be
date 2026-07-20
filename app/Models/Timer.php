<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Timer extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_uuid',
        'pc_exca_uuid',

        // TIME
        'tgl',
        'start_time',
        'stop_time',

        // GENERAL
        'job_site',
        'user',
        'fill_factor',
        'hauler_quantity',

        // PCEXCA
        'pc_exca',
        'model',
        'ct_45',
        'bucket_cap',
        'swell_factor',
        'density',
        'direct_excavation',
        'correction_factor',

        // Total
        'total_cycle',
        'total_plan_sw45',
        'total_duration',
        'total_ration',

        // Primary Work
        'primary_work_plan_sw45',
        'primary_work_actual',
        'primary_work_duration',
        'primary_work_ration',

        // Dig to Load
        'dig_to_load_plan_sw45',
        'dig_to_load_actual',
        'dig_to_load_duration',
        'dig_to_load_ration',

        // Swing Loaded
        'swing_loaded_plan_sw45',
        'swing_loaded_actual',
        'swing_loaded_duration',
        'swing_loaded_ration',

        // Dump
        'dump_plan_sw45',
        'dump_actual',
        'dump_duration',
        'dump_ration',

        // Swing Empty
        'swing_empty_plan_sw45',
        'swing_empty_actual',
        'swing_empty_duration',
        'swing_empty_ration',

        // Secondary Work
        'secondary_work_plan_sw45',
        'secondary_work_actual',
        'secondary_work_duration',
        'secondary_work_ration',

        // Clearing
        'clearing_plan_sw45',
        'clearing_actual',
        'clearing_duration',
        'clearing_ration',

        // Travel Position
        'travel_pos_plan_sw45',
        'travel_pos_actual',
        'travel_pos_duration',
        'travel_pos_ration',

        // Dig to Prepare
        'dig_to_prepare_plan_sw45',
        'dig_to_prepare_actual',
        'dig_to_prepare_duration',
        'dig_to_prepare_ration',

        // Wait to Dump
        'wait_to_dump_plan_sw45',
        'wait_to_dump_actual',
        'wait_to_dump_duration',
        'wait_to_dump_ration',

        // No Activity
        'no_activity_plan_sw45',
        'no_activity_actual',
        'no_activity_duration',
        'no_activity_ration',

        // Idle
        'idle_plan_sw45',
        'idle_actual',
        'idle_duration',
        'idle_ration',

        // Operator Change
        'operator_change_plan_sw45',
        'operator_change_actual',
        'operator_change_duration',
        'operator_change_ration',

        // Exchange Change
        'ex_change_plan_sw45',
        'ex_change_actual',
        'ex_change_duration',
        'ex_change_ration',

        // Final Stats
        'average_passes',
        'average_ct',
        'production',
        'productivity',
        'fuel_consumption_liter',
        'fuel_consumption_liter_hour',
        'fuel_consumption_liter_bcm',
    ];

    protected $casts = [
        'tgl' => 'date',
        'start_time' => 'datetime',
        'stop_time' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($timer) {
            if (empty($timer->uuid)) {
                $timer->uuid = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function pcExca()
    {
        return $this->belongsTo(PcExca::class, 'pc_exca_uuid', 'uuid');
    }

    public function detailTimer()
    {
        return $this->hasMany(DetailTimer::class, 'timer_uuid', 'uuid');
    }

    public function haulerLog()
    {
        return $this->hasMany(HaulerLog::class, 'timer_uuid', 'uuid');
    }

    public function fillFactorTimer()
    {
        return $this->hasMany(FillFactorTimer::class, 'timer_uuid', 'uuid');
    }
}
