<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pc_excas', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('pc_exca');
            $table->double('swell_factor')->default(0.0);
            $table->double('ct_45')->default(0.0);
            $table->string('model');
            $table->double('bucket_cap')->default(0.0);
            $table->double('fuel_consumption')->default(0.0);
            $table->double('density')->default(0.0);
            $table->boolean('direct_excavation')->default(true);

            $table->double('total_plan_sw45')->default(0.0);
            $table->double('primary_work_plan_sw45')->default(0.0);
            $table->double('dig_to_load_plan_sw45')->default(0.0);
            $table->double('swing_loaded_plan_sw45')->default(0.0);
            $table->double('dump_plan_sw45')->default(0.0);
            $table->double('swing_empty_plan_sw45')->default(0.0);
            $table->double('secondary_work_plan_sw45')->default(0.0);
            $table->double('clearing_plan_sw45')->default(0.0);
            $table->double('travel_pos_plan_sw45')->default(0.0);
            $table->double('dig_to_prepare_plan_sw45')->default(0.0);
            $table->double('wait_to_dump_plan_sw45')->default(0.0);
            $table->double('no_activity_plan_sw45')->default(0.0);
            $table->double('idle_plan_sw45')->default(0.0);
            $table->double('operator_change_plan_sw45')->default(0.0);
            $table->double('ex_change_plan_sw45')->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pc_excas');
    }
};
