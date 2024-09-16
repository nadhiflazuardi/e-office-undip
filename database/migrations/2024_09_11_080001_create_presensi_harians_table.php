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
        Schema::create('presensi_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('user');
            $table->foreignId('ip_login_id')->constrained('ip_login');
            $table->dateTime('waktu_kehadiran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_harian');
    }
};
