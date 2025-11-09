<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('treatment_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('treatment_id')->constrained()->onDelete('cascade');
            $table->date('preferred_date');
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->text('message')->nullable();

            // ✅ Status added
            $table->boolean('status')->default(false)->comment('0 = Pending, 1 = Contacted');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_consultations');
    }
};
