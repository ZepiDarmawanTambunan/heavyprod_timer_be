<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PcExca extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'pc_exca',
        'swell_factor',
        'model',
        'bucket_cap',
        'ct_45',
        'fuel_consumption',
        'density',
        'direct_excavation',

        'total_plan_sw45',
        'primary_work_plan_sw45',
        'dig_to_load_plan_sw45',
        'swing_loaded_plan_sw45',
        'dump_plan_sw45',
        'swing_empty_plan_sw45',
        'secondary_work_plan_sw45',
        'clearing_plan_sw45',
        'travel_pos_plan_sw45',
        'dig_to_prepare_plan_sw45',
        'wait_to_dump_plan_sw45',
        'no_activity_plan_sw45',
        'idle_plan_sw45',
        'operator_change_plan_sw45',
        'ex_change_plan_sw45',
    ];

    protected $casts = [
        'swell_factor' => 'double',
        'bucket_cap' => 'double',
        'ct_45' => 'double',
        'fuel_consumption' => 'double',
        'direct_excavation' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($pcExca) {
            if (empty($pcExca->uuid)) {
                $pcExca->uuid = (string) Str::uuid();
            }
        });
    }
}
