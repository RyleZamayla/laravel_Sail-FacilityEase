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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buildingID')->constrained('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('buildingFloorID')->constrained('building_floors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('userRoleID')->constrained('user_roles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('facility');
            $table->integer('capacity');
            $table->integer('noOfHours');
            $table->time('openTime');
            $table->time('closeTime');
            $table->integer('maxDays')->default(3);
            $table->integer('maxHours')->default(8);
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->string('img_url')->nullable();
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
        Schema::dropIfExists('facilities');
    }
};
