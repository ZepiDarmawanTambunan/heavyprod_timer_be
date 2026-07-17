<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HaulerLog extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'uuid',
        'timer_uuid',
        'cycle_number',
        'hauler_label',
        'created_at',
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
