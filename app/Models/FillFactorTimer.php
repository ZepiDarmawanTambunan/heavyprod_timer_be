<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FillFactorTimer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'uuid',
        'timer_uuid',
        'cycle_number',
        'fill_factor',
        'created_at',
    ];

    protected $casts = [
        'fill_factor' => 'double',
        'created_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($fillFactor) {
            if (empty($fillFactor->uuid)) {
                $fillFactor->uuid = (string) Str::uuid();
            }
        });
    }

    public function timer()
    {
        return $this->belongsTo(Timer::class, 'timer_uuid', 'uuid');
    }
}
