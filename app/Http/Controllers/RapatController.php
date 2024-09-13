<?php

namespace App\Http\Controllers;


use App\Http\Requests\RapatRequest;
use App\Models\Pegawai;
use App\Models\PresensiRapat;
use App\Models\Rapat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RapatController extends Controller
{
    public function index()
    {
        $events = array();
        $rapats = Rapat::all();
        foreach ($rapats as $rapat) {
            $events[] = [
                'id' => $rapat->id,
                'title' => $rapat->judul,
                'perihal' => $rapat->perihal,
                'tempat' => $rapat->tempat,
                'pemimpinRapat' => $rapat->pemimpin_rapat_id,
                'start' => $rapat->waktu_mulai,
                'end' => $rapat->waktu_selesai,
                'color' => $rapat->warna_label ? $rapat->warna_label : '',
                'startTime' => Carbon::parse($rapat->waktu_mulai)->format('H:i:s'),
                'endTime' => Carbon::parse($rapat->waktu_selesai)->format('H:i:s'),
            ];
        }

        return view('rapat.index', compact('events'));
    }

    public function store(RapatRequest $request)
    {
        $rapat = Rapat::create(
            [
                'judul' => $request->judul,
                'perihal' => $request->perihal,
                'tempat' => $request->tempat,
                'pemimpin_rapat_id' => $request->pemimpinRapat,
                'waktu_mulai' => $request->waktuMulai,
                'waktu_selesai' => $request->waktuSelesai,
                'warna_label' => $request->warnaLabel,
            ]
        );

        return response()->json([
            'id' => $rapat->id,
            'title' => $rapat->judul,
            'start' => $rapat->waktu_mulai,
            'end' => $rapat->waktu_selesai,
            'color' => $rapat->warna_label ? $rapat->warna_label : '',
            'startTime' => Carbon::parse($rapat->waktu_mulai)->format('H:i:s'),
            'endTime' => Carbon::parse($rapat->waktu_selesai)->format('H:i:s'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $rapat = Rapat::findOrFail($id);
        // if rapat not found, return 404
        if (!$rapat) {
            return response()->json(['error' => 'rapat not found'], 404);
        }

        // if request doesn't have color, it means the process is drag and drop
        if (!$request->warnaLabel) {
            $rapat->update([
                'waktu_mulai' => $request->waktuMulai,
                'waktu_selesai' => $request->waktuSelesai,
            ]);

            return response()->json($rapat);
        }

        $rapat->update([
            'judul' => $request->judul,
            'perihal' => $request->perihal,
            'tempat' => $request->tempat,
            'pemimpin_rapat_id' => $request->pemimpinRapat,
            'waktu_mulai' => $request->waktuMulai,
            'waktu_selesai' => $request->waktuSelesai,
            'warna_label' => $request->warnaLabel,
        ]);

        return response()->json([
            'id' => $rapat->id,
            'title' => $rapat->judul,
            'start' => $rapat->waktu_mulai,
            'end' => $rapat->waktu_selesai,
            'color' => $rapat->warna_label ? $rapat->warna_label : '',
            'startTime' => Carbon::parse($rapat->waktu_mulai)->format('H:i:s'),
            'endTime' => Carbon::parse($rapat->waktu_selesai)->format('H:i:s'),
        ]);
    }

    public function destroy($id)
    {
        $rapat = Rapat::findOrFail($id);

        $rapat->delete();

        return response()->json($rapat);
    }

    public function updatePresensiPeserta(Request $request, Rapat $rapat, Pegawai $peserta)
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
