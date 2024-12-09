<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\VerifikasiSuratKeluar;
use Illuminate\Http\Request;

class VerifikasiSuratKeluarController extends Controller
{
    public function index() {
        $title = 'Verifikasi Surat Keluar';

        $user = auth()->user();
        $suratKeluar = SuratKeluar::whereHas('penulis', function($query) use ($user) {
            $query->where('unit_kerja_id', $user->unit_kerja_id);
        });
        
        if ($user->hasRole('Supervisor')) {
            $suratMenungguVerifikasi = $suratKeluar->clone()->where('status', 'Menunggu Persetujuan Supervisor')->latest()->get();
        }
        if ($user->hasRole('Wakil Dekan')) {
            $suratMenungguVerifikasi = $suratKeluar->clone()->where('status', 'Menunggu Persetujuan Wakil Dekan')->latest()->get();
        }
        if ($user->hasRole('Dekan')) {
            $suratMenungguVerifikasi = $suratKeluar->clone()->where('status', 'Menunggu Persetujuan Dekan')->latest()->get();
        }
        $suratPerluPerbaikan = $suratKeluar->clone()->where('status', 'like', 'Revisi%')->latest()->get();
        $suratDisetujui = $suratKeluar->clone()->where('status', 'Disetujui')->latest()->get();

        return view('surat-keluar.verifikasi.index',compact('title','suratMenungguVerifikasi','suratPerluPerbaikan','suratDisetujui'));
    }

    public function show(SuratKeluar $surat) {

        return view('surat-keluar.verifikasi.show',compact('surat'));
    }

    public function terima(SuratKeluar $surat)
    {
        // dd('sampe sini');

        $user = auth()->user();

        if ($user->hasRole('Supervisor')) {
            $statusSurat =  'Menunggu Persetujuan Wakil Dekan';
            $nextVerifikatorId = $user->supervisor_id;
        }
        if ($user->hasRole('Wakil Dekan')) {
            $statusSurat =  'Menunggu Persetujuan Dekan';
            $nextVerifikatorId = $user->supervisor_id;
        }
        if ($user->hasRole('Dekan')) {
            $statusSurat =  'Disetujui';
            $nextVerifikatorId = null;
        }

        $surat->update([
            'status' => $statusSurat,
            'next_verifikator_id' => $nextVerifikatorId,
        ]);

        VerifikasiSuratKeluar::create([
            'surat_keluar_id' => $surat->id,
            'verifikatur_id' => auth()->id(),
            'status' => 'Disetujui',
        ]);

        // TODO : Hitung bobot dan bikin log

        // $bobot = $this->hitungBobotPerjalananDinas($laporan->perjalananDinas->waktu_mulai, $laporan->perjalananDinas->waktu_selesai);
        // Log::create([
        //     'pegawai_id' => auth()->id(),
        //     'kegiatan_id' => $laporan->perjalananDinas->id,
        //     'bobot' => $bobot,
        // ]);

        return redirect()->route('surat-keluar.verifikasi.show',['surat' => $surat])->with('success', 'Surat keluar berhasil diverifikasi');

    }

    public function tolak(Request $request, SuratKeluar $surat)
    {
        // dd('sampe sini');
        $request->validate([
            'catatan' => 'required',
        ]);

        $user = auth()->user();

        if ($user->hasRole('Supervisor')) {
            $statusSurat =  'Revisi Oleh Supervisor';
        }
        if ($user->hasRole('Wakil Dekan')) {
            $statusSurat =  'Revisi Oleh Wakil Dekan';
        }
        if ($user->hasRole('Dekan')) {
            $statusSurat =  'Revisi Oleh Dekan';
        }

        $surat->update([
            'status' => $statusSurat,
            'next_verifikator_id' => $surat->penulis_id,
        ]);

        VerifikasiSuratKeluar::create([
            'surat_keluar_id' => $surat->id,
            'verifikatur_id' => auth()->id(),
            'status' => 'Ditolak',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('surat-keluar.verifikasi.show',['surat' => $surat])->with('success', 'Surat Keluar berhasil diverifikasi');
    }
}
