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
        Schema::create('fill_factor_timers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('timer_uuid');

            $table->integer('cycle_number')->nullable();
            $table->double('fill_factor')->default(0.0);
            $table->dateTime('created_at')->nullable();

            $table->foreign('timer_uuid')->references('uuid')->on('timers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill_factor_timers');
    }
};
