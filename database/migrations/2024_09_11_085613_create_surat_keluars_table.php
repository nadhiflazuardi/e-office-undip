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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->string('id')->primary(); // Set id sebagai primary key
            $table->foreignId('penulis_id')->constrained('user');
            $table->string('nomor_surat');
            $table->string('perihal');
            $table->string('asal');
            $table->string('tujuan');
            $table->string('alamat_surat');
            $table->foreignId('penandatangan_id')->constrained('user');
            $table->string('file_surat');
            $table->string('file_arsip')->nullable();
            $table->date('tanggal_dikirim');
            $table->enum('status', ['Disetujui',
                                    'Menunggu Persetujuan Supervisor',
                                    'Revisi Oleh Supervisor',
                                    'Menunggu Persetujuan Wakil Dekan',
                                    'Revisi Oleh Wakil Dekan',
                                    'Menunggu Persetujuan Dekan',
                                    'Revisi Oleh Dekan'])->default('Menunggu Persetujuan Supervisor');
            $table->foreignId('next_verifikator_id')->nullable()->constrained('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
