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
            'status' => 'diterima',
        ]);

        VerifikasiLaporanPerjalananDinas::create([
            'laporan_perjalanan_dinas_id' => $laporan->id,
            'verifikatur_id' => auth()->id(),
            'status' => 'diterima',
        ]);

        return redirect()->route('laporan-dinas.verifikasi.show', ['laporan' => $laporan->id]);
    }

    public function tolak(Request $request, LaporanPerjalananDinas $laporan)
    {
        $laporan->update([
            'status' => 'ditolak',
        ]);

        VerifikasiLaporanPerjalananDinas::create([
            'laporan_perjalanan_dinas_id' => $laporan->id,
            'verifikatur_id' => auth()->id(),
            'status' => 'ditolak',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('laporan-dinas.verifikasi.show', ['laporan' => $laporan->id]);
    }
}
