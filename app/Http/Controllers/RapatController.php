<?php

namespace App\Http\Controllers;

use App\Http\Requests\RapatRequest;
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

}
