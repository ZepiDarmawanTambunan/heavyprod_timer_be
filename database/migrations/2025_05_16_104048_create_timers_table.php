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
        Schema::create('timers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('user_uuid')->nullable();
            $table->string('pc_exca_uuid')->nullable();

            // TIMEc
            $table->dateTime('start_time');
            $table->dateTime('stop_time');
            $table->date('tgl');

            // GENERAL
            $table->string('job_site')->nullable();
            $table->string('user');
            $table->integer('hauler_quantity')->default(0);
            $table->double('fill_factor')->default(0.0);

            // PCEXCA
            $table->string('pc_exca');
            $table->string('model');
            $table->double('ct_45')->default(0clear.0);
            $table->double('bucket_cap')->default(0.0);
            $table->double('swell_factor')->default(0.0);
            $table->double('density')->default(0.0);
            $table->boolean('direct_excavation')->default(true);

            // Total
            $table->integer('total_cycle')->default(1);
            $table->double('total_plan_sw45')->default(0.0);
            $table->double('total_duration')->default(0.0);
            $table->double('total_ration')->default(0.0);

            // Primary Work
            $table->double('primary_work_plan_sw45')->default(0.0);
            $table->double('primary_work_actual')->default(0.0);
            $table->double('primary_work_duration')->default(0.0);
            $table->double('primary_work_ration')->default(0.0);

            // Dig to Load
            $table->double('dig_to_load_plan_sw45')->default(0.0);
            $table->double('dig_to_load_actual')->default(0.0);
            $table->double('dig_to_load_duration')->default(0.0);
            $table->double('dig_to_load_ration')->default(0.0);

            // Swing Loaded
            $table->double('swing_loaded_plan_sw45')->default(0.0);
            $table->double('swing_loaded_actual')->default(0.0);
            $table->double('swing_loaded_duration')->default(0.0);
            $table->double('swing_loaded_ration')->default(0.0);

            // Dump
            $table->double('dump_plan_sw45')->default(0.0);
            $table->double('dump_actual')->default(0.0);
            $table->double('dump_duration')->default(0.0);
            $table->double('dump_ration')->default(0.0);

            // Swing Empty
            $table->double('swing_empty_plan_sw45')->default(0.0);
            $table->double('swing_empty_actual')->default(0.0);
            $table->double('swing_empty_duration')->default(0.0);
            $table->double('swing_empty_ration')->default(0.0);

            // Secondary Work
            $table->double('secondary_work_plan_sw45')->default(0.0);
            $table->double('secondary_work_actual')->default(0.0);
            $table->double('secondary_work_duration')->default(0.0);
            $table->double('secondary_work_ration')->default(0.0);

            // Clearing
            $table->double('clearing_plan_sw45')->default(0.0);
            $table->double('clearing_actual')->default(0.0);
            $table->double('clearing_duration')->default(0.0);
            $table->double('clearing_ration')->default(0.0);

            // Travel Position
            $table->double('travel_pos_plan_sw45')->default(0.0);
            $table->double('travel_pos_actual')->default(0.0);
            $table->double('travel_pos_duration')->default(0.0);
            $table->double('travel_pos_ration')->default(0.0);

            // Dig to Prepare
            $table->double('dig_to_prepare_plan_sw45')->default(0.0);
            $table->double('dig_to_prepare_actual')->default(0.0);
            $table->double('dig_to_prepare_duration')->default(0.0);
            $table->double('dig_to_prepare_ration')->default(0.0);

            // Wait to Dump
            $table->double('wait_to_dump_plan_sw45')->default(0.0);
            $table->double('wait_to_dump_actual')->default(0.0);
            $table->double('wait_to_dump_duration')->default(0.0);
            $table->double('wait_to_dump_ration')->default(0.0);

            // No Activity
            $table->double('no_activity_plan_sw45')->default(0.0);
            $table->double('no_activity_actual')->default(0.0);
            $table->double('no_activity_duration')->default(0.0);
            $table->double('no_activity_ration')->default(0.0);

            // Idle
            $table->double('idle_plan_sw45')->default(0.0);
            $table->double('idle_actual')->default(0.0);
            $table->double('idle_duration')->default(0.0);
            $table->double('idle_ration')->default(0.0);

            // Operator Change
            $table->double('operator_change_plan_sw45')->default(0.0);
            $table->double('operator_change_actual')->default(0.0);
            $table->double('operator_change_duration')->default(0.0);
            $table->double('operator_change_ration')->default(0.0);

            // Ex Change
            $table->double('ex_change_plan_sw45')->default(0.0);
            $table->double('ex_change_actual')->default(0.0);
            $table->double('ex_change_duration')->default(0.0);
            $table->double('ex_change_ration')->default(0.0);

            // Final Stats
            $table->double('average_passes')->default(0.0);
            $table->double('average_ct')->default(0.0);
            $table->double('production')->default(0.0);
            $table->double('productivity')->default(0.0);
            $table->double('fuel_consumption_liter')->default(0.0);
            $table->double('fuel_consumption_liter_hour')->default(0.0);
            $table->double('fuel_consumption_liter_bcm')->default(0.0);

            $table->timestamps();

            $table->foreign('user_uuid')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('pc_exca_uuid')->references('uuid')->on('pc_excas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timers');
    }
};
