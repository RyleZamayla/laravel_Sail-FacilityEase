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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facilityID')->constrained('facilities')->onDelete('cascade')->onUpdate('cascade');
            $table->string('equipment');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->integer('quantity');
            $table->enum('status', ['SERVICEABLE', 'NON-SERVICEABLE', 'UNDER-REPAIR'])->default('SERVICEABLE');
            $table->string('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
