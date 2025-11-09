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
        Schema::create('doctor_slots', function (Blueprint $table) {
            $table->id();

            // Doctor reference
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();

            // Slot details
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');

            // Management
            $table->unsignedTinyInteger('max_patients')->default(1); // 1 patient per slot
            $table->unsignedTinyInteger('booked_count')->default(0); // Track bookings
            $table->boolean('is_booked')->default(false); // Mark when fully booked

            $table->timestamps();

            // Prevent duplicate slots
            $table->unique(['doctor_id', 'date', 'start_time', 'end_time'], 'unique_slot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_slots');
    }
};
