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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable(); // foto layanan
            $table->string('nama'); // nama layanan
            $table->enum('jenis', ['R', 'M', 'C', 'D']); // Regular, Medium, Complete, Drywash
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('harga'); // harga dalam rupiah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
