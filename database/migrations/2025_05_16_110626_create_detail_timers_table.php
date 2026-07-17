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
        Schema::create('detail_timers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('timer_uuid');
            $table->integer('detik')->default(0);
            $table->integer('cycle_number')->nullable();

            $table->string('aktivitas_uuid')->nullable();
            $table->string('aktivitas');
            $table->string('kategori_aktivitas');

            $table->dateTime('start_time');
            $table->dateTime('stop_time');

            $table->timestamps();
            $table->foreign('timer_uuid')->references('uuid')->on('timers')->onDelete('cascade');
            $table->foreign('aktivitas_uuid')->references('uuid')->on('aktivitas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_timers');
    }
};
