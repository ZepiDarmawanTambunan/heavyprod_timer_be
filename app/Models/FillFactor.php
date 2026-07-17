<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FillFactor extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'fill_factor',
    ];

    protected static function booted()
    {
        static::creating(function ($aktivitas) {
            if (empty($aktivitas->uuid)) {
                $aktivitas->uuid = (string) Str::uuid();
            }
        });
    }
}
