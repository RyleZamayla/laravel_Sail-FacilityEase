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
        Schema::create('reservation_equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservationID')->constrained('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('equipmentID')->constrained('equipment')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_equipments');
    }
};
