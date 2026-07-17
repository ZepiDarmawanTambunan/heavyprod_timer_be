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
        Schema::create('hauler_logs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('timer_uuid');
            $table->integer('cycle_number')->nullable();
            $table->string('hauler_label');
            $table->dateTime('created_at')->nullable();
            $table->foreign('timer_uuid')->references('uuid')->on('timers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hauler_logs');
    }
};
