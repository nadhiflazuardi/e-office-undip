<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rapat extends Model
{
    use HasFactory;

    protected $table = 'rapat';

    protected $guarded = ['id'];

    // Relationship ke model PresensiRapat
    public function presensiRapat()
    {
        return $this->hasMany(PresensiRapat::class);
    }

    public function tanggal()
    {
        return Carbon::parse($this->waktu_mulai)->toDateString(); // Mengembalikan format YYYY-MM-DD
    }

    // Method untuk format tanggal
    public function hariTanggal()
    {
        return Carbon::parse($this->start_time)->translatedFormat('l, j F Y');
    }

    // Method untuk format waktu mulai
    public function waktuMulai()
    {
        return Carbon::parse($this->start_time)->format('H:i');
    }

    // Method untuk format waktu selesai
    public function waktuSelesai()
    {
        return Carbon::parse($this->end_time)->format('H:i');
    }

    // Method untuk mengambil status kehadiran user yang sedang login
    public function attendanceOfLoggedInUser()
    {
        // Ambil user yang login
        $loggedInUserId = Auth::id();

        // Cari data presensi rapat yang sesuai dengan user yang login
        $presensi = $this->presensiRapat()->where('pegawai_id', $loggedInUserId)->first();

        // Kalau ada presensi, return statusnya, kalau nggak ada return 'Belum hadir'
        return $presensi->status;
    }
}
