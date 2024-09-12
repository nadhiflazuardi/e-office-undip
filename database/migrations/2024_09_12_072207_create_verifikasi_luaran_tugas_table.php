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
        Schema::create('verifikasi_luaran_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('luaran_tugas_id')->constrained('luaran_tugas');
            $table->foreignId('verifikatur_id')->constrained('pegawai');
            $table->enum('status', ['disetujui', 'ditolak']);
            $table->string('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_luaran_tugas');
    }
};
