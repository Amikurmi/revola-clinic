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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id(); // Primary key

            // Basic Info
            $table->string('name'); // Doctor name
            $table->string('specialization')->nullable(); // Optional specialization

            // Profile Info
            $table->string('email')->unique()->nullable(); // Optional email contact
            $table->string('phone')->nullable(); // Contact number
            $table->string('image')->nullable(); // Optional image path

            // Professional Details
            $table->decimal('rating', 2, 1)->default(0); // Rating (e.g., 4.5)
            $table->integer('experience_years')->default(0); // Optional years of experience
            $table->text('bio')->nullable(); // Short about/description

            // Status & Availability
            $table->boolean('is_active')->default(true); // Active/inactive doctor

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
