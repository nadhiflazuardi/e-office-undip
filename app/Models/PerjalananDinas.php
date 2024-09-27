<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjalananDinas extends Model
{
    use HasFactory;

    protected $table = 'perjalanan_dinas';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Buat placeholder terlebih dahulu
            $model->nomor_surat = 'SPPD';
        });

        static::created(function ($model) {
            // Update nomor_surat dengan ID yang sudah tersedia
            $model->nomor_surat = 'SPPD/' . now()->format('Ymd') . "/" . $model->id;
            $model->save(); // Simpan perubahan ke database
        });
    }

    public function pemberiPerintah()
    {
        return $this->belongsTo(User::class, 'pemberi_perintah_id');
    }

    public function pelaksana()
    {
        return $this->belongsTo(User::class, 'pelaksana_id');
    }

    public function tanggalMulai()
    {
        return Carbon::parse($this->tanggal_mulai)->translatedFormat('l, j F Y');
    }
    public function tanggalSelesai()
    {
        return Carbon::parse($this->tanggal_selesai)->translatedFormat('l, j F Y');
    }

    public function laporanPerjalananDinas() {
        return $this->hasOne(LaporanPerjalananDinas::class);
    }
}
