<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'dig to load',
            'kategori' => 'primary work',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'swing loaded',
            'kategori' => 'primary work',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'dump',
            'kategori' => 'primary work',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'swing empty',
            'kategori' => 'primary work',
        ]);


        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'clearing',
            'kategori' => 'secondary work',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'travel/positioning',
            'kategori' => 'secondary work',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'dig to prepare',
            'kategori' => 'secondary work',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'wait to dump',
            'kategori' => 'secondary work',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'idle',
            'kategori' => 'no activity',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'operator change',
            'kategori' => 'no activity',
        ]);

        Aktivitas::create([
            'uuid' => (string) Str::uuid(),
            'aktivitas' => 'ex change',
            'kategori' => 'no activity',
        ]);
    }
}
