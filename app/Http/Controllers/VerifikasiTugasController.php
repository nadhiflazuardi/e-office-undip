<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\LuaranTugas;
use App\Models\VerifikasiLuaranTugas;
use Illuminate\Http\Request;

class VerifikasiTugasController extends Controller
{
    public function index()
    {
        $title = 'Verifikasi Tugas';
        return view('tugas.verifikasi.index', compact('title'));
    }

    public function show()
    {
        $title = 'Verifikasi Tugas';
        return view('tugas.verifikasi.show', compact('title'));
    }

    public function terima(LuaranTugas $tugas)
    {
        $tugas->update([
            'status' => 'diterima',
        ]);

        VerifikasiLuaranTugas::create([
            'luaran_tugas_id' => $tugas->id,
            'verifikatur_id' => auth()->id(),
            'status' => 'diterima',
        ]);

        $bobot = $tugas->detailAbk->waktu_penyelesaian;
        Log::create([
            'pegawai_id' => auth()->id(),
            'kegiatan_id' => $tugas->id,
            'bobot' => $bobot,
        ]);

        return redirect()->route('tugas.verifikasi.show', ['tugas' => $tugas->id]);
    }

    public function tolak(Request $request, LuaranTugas $tugas)
    {
        $tugas->update([
            'status' => 'ditolak',
        ]);

        VerifikasiLuaranTugas::create([
            'luaran_tugas_id' => $tugas->id,
            'verifikatur_id' => auth()->id(),
            'status' => 'ditolak',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('tugas.verifikasi.show', ['tugas' => $tugas->id]);
    }
}
