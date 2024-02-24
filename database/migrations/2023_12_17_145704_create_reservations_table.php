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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('facilityID')->constrained('facilities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('roleID')->constrained('user_roles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('event');
            $table->date('startDate');
            $table->smallInteger('noOfdays');
            $table->date('endDate');
            $table->smallInteger('occupants');
            $table->enum('status', ['PENDING', 'PENCILBOOKED', 'APPROVED', 'DECLINED', 'CANCELLED', 'OCCUPIED', 'REVOKED', 'RESCHEDULED'])->default('PENDING');
            $table->string('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
