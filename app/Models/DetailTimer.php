<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DetailTimer extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'timer_uuid',
        'detik',
        'cycle_number',
        'aktivitas_uuid',
        'aktivitas',
        'kategori_aktivitas',
        'start_time',
        'stop_time',
    ];

    protected $casts = [
        'detik' => 'integer',
        'start_time' => 'datetime',
        'stop_time' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($detailTimer) {
            if (empty($detailTimer->uuid)) {
                $detailTimer->uuid = (string) Str::uuid();
            }
        });
    }

    public function timer()
    {
        return $this->belongsTo(Timer::class, 'timer_uuid', 'uuid');
    }

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class, 'aktivitas_uuid', 'uuid');
    }
}
