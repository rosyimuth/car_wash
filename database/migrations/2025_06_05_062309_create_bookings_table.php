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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade'); // Relasi ke tabel schedules
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // Relasi ke tabel services
            $table->string('plat_nomor'); // Plat nomor kendaraan
            $table->string('merk'); // Merek kendaraan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
