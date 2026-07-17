<?php

namespace Database\Seeders;

use App\Models\FillFactor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FillFactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FillFactor::create([
            'uuid' => (string) Str::uuid(),
            'fill_factor' => 0.7,
        ]);

        FillFactor::create([
            'uuid' => (string) Str::uuid(),
            'fill_factor' => 0.8,
        ]);

        FillFactor::create([
            'uuid' => (string) Str::uuid(),
            'fill_factor' => 0.9,
        ]);

        FillFactor::create([
            'uuid' => (string) Str::uuid(),
            'fill_factor' => 1.0,
        ]);

        FillFactor::create([
            'uuid' => (string) Str::uuid(),
            'fill_factor' => 1.1,
        ]);

        FillFactor::create([
            'uuid' => (string) Str::uuid(),
            'fill_factor' => 1.2,
        ]);
    }
}
