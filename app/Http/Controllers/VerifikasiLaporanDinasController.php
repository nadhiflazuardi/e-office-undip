<?php

namespace App\Http\Controllers;

use App\Models\LaporanPerjalananDinas;
use App\Models\VerifikasiLaporanPerjalananDinas;
use Illuminate\Http\Request;

class VerifikasiLaporanDinasController extends Controller
{
    public function index()
    {
        $title = 'Verifikasi';

        return view('laporan-dinas.verifikasi.index', compact('title'));
    }

    public function show()
    {
        $title = 'Verifikasi';

        return view('laporan-dinas.verifikasi.show', compact('title'));
    }

    public function terima(LaporanPerjalananDinas $laporan)
    {
        $laporan->update([
            'status' => 'Disetujui',
        ]);

        VerifikasiLaporanPerjalananDinas::create([
            'laporan_id' => $laporan->id,
            'verifikatur_id' => auth()->id(),
            'status' => 'Disetujui',
        ]);

        return redirect()->route('laporan-dinas.index')->with('success', 'Laporan perjalanan dinas berhasil diverifikasi');
    }

    public function tolak(Request $request, LaporanPerjalananDinas $laporan)
    {
        $request->validate([
            'catatan' => 'required',
        ]);

        $laporan->update([
            'status' => 'Ditolak',
        ]);

        VerifikasiLaporanPerjalananDinas::create([
            'laporan_id' => $laporan->id,
            'verifikatur_id' => auth()->id(),
            'status' => 'Ditolak',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('laporan-dinas.index')->with('success', 'Laporan perjalanan dinas berhasil diverifikasi');
    }
}
