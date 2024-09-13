<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RapatController extends Controller
{
    public function updatePresensiPeserta(Request $request, Rapat $rapat, Peserta $peserta)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,notset',
        ]);

        PresensiRapat::where('rapat_id', $rapat->id)
            ->where('peserta_id', $peserta->id)
            ->update([
                'status' => $request->status,
                'alasan' => $request->alasan,
            ]);

        return response()->json([
            'message' => 'Presensi peserta rapat berhasil diupdate.',
        ]);
    }
}
