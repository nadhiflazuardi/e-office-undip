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
        Schema::create('presensi_rapat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rapat_id')->constrained('rapat');
            $table->foreignId('pegawai_id')->constrained('user');
            $table->enum('status', ['hadir', 'izin', 'notset'])->default('notset');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_rapat');
    }
};
