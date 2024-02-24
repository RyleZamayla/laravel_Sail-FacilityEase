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
        Schema::create('building_floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buildingID')->constrained('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('floorNumber');
            $table->string('created_by');
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_floors');
    }
};
