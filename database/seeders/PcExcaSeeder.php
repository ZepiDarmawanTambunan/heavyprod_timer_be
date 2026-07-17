<?php

namespace Database\Seeders;

use App\Models\PcExca;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PcExcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PcExca::create([
            'uuid' => (string) Str::uuid(),
            'pc_exca' => 'PC1250',          // contoh nama alat
            'swell_factor' => 1.2,         // contoh nilai swell factor
            'ct_45' => 30.0,                // contoh nilai ct_45
            'model' => 'Komatsu PC1250',    // contoh model alat
            'bucket_cap' => 6.2,            // contoh kapasitas bucket (m3)
            'fuel_consumption' => 45.0,      // contoh konsumsi bahan bakar (liter/jam)
            'density' => 1.8,               // contoh density (ton/m3)
            'direct_excavation' => true,    // contoh boolean

            'total_plan_sw45' => 0.0,
            'primary_work_plan_sw45' => 25.00,
            'dig_to_load_plan_sw45' => 11.36,
            'swing_loaded_plan_sw45' => 5.58,
            'dump_plan_sw45' => 3.41,
            'swing_empty_plan_sw45' => 4.55,

            'secondary_work_plan_sw45' => 25.00,
            'clearing_plan_sw45' => 11.36,
            'travel_pos_plan_sw45' => 5.58,
            'dig_to_prepare_plan_sw45' => 3.41,
            'wait_to_dump_plan_sw45' => 4.55,

            'no_activity_plan_sw45' => 0.0,
            'idle_plan_sw45' => 0.0,
            'operator_change_plan_sw45' => 0.0,
            'ex_change_plan_sw45' => 0.0,
        ]);
    }
}
