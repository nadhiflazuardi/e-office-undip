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
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemberi_perintah_id')->constrained('users');
            $table->foreignId('jabatan_pemberi_perintah_id')->constrained('jabatan');
            $table->foreignId('pelaksana_id')->constrained('users');
            $table->foreignId('jabatan_pelaksana_id')->constrained('jabatan');
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');
            $table->string('tujuan_perjalanan');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->unsignedBigInteger('anggaran');
            $table->string('keterangan');
            $table->string('file_sppd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
};
