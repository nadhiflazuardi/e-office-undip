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
        Schema::create('laporan_perjalanan_dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai');
            $table->foreignId('perjalanan_dinas_id')->constrained('perjalanan_dinas');
            $table->string('file_laporan');
            $table->string('keterangan');
            $table->dateTime('waktu_pengumpulan');
            $table->enum('status', ['Disetujui', 'Dalam Proses', 'Ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_perjalanan_dinas');
    }
};
