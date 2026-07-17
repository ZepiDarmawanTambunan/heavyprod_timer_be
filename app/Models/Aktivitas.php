<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Aktivitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'aktivitas',
        'kategori'
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
