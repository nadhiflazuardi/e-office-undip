<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratKeluarRequest;
use App\Models\Log;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $title = 'Surat Keluar';
        return view('surat-keluar.index', compact('title'));
    }

    public function create()
    {
        $title = 'Tambah Surat Keluar';
        return view('surat-keluar.create', compact('title'));
    }

    public function store(SuratKeluarRequest $request)
    {
        $surat = $request->file('file_surat');
        $namaSurat = time() . '_' . $surat->getClientOriginalName();
        $surat->storeAs('surat_keluar', $namaSurat, 'public');

        // Simpan data surat
        $surat = SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'perihal' => $request->perihal,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'file_surat' => $namaSurat,
            'tanggal_surat' => $request->tanggal_surat,
        ]);

        Log::create([
            'pegawai_id' => auth()->id(),
            'kegiatan_id' => $surat->id,
            'bobot' => 30,
        ]);

        return redirect()->route('surat-keluar.index');
    }

    public function show(SuratKeluar $surat)
    {
        $title = 'Detail Surat Keluar';
        return view('surat-keluar.show', compact('title', 'surat'));
    }

    public function edit(SuratKeluar $surat)
    {
        $title = 'Edit Surat Keluar';
        return view('surat-keluar.edit', compact('title', 'surat'));
    }

    public function update(SuratKeluarRequest $request, SuratKeluar $surat)
    {
        // Cek kalo ada file baru di request
        if ($request->hasFile('file_surat')) {
            // Hapus file lama
            $fileLama = storage_path('app/surat_keluar/' . $surat->file_surat);
            if (file_exists($fileLama)) {
                unlink($fileLama);
            }

            // Upload file baru
            $surat = $request->file('file_surat');
            $namaSurat = time() . '_' . $surat->getClientOriginalName();
            $surat->storeAs('surat_keluar', $namaSurat, 'public');
        }

        // Update data surat
        $surat->update([
            'nomor_surat' => $request->nomor_surat,
            'perihal' => $request->perihal,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'file_surat' => $namaSurat,
            'tanggal_surat' => $request->tanggal_surat,
        ]);

        return redirect()->route('surat-keluar.index');
    }

    public function destroy(SuratKeluar $surat)
    {
        $fileLama = storage_path('app/surat_keluar/' . $surat->file_surat);
        if (file_exists($fileLama)) {
            unlink($fileLama);
        }

        $surat->delete();
        return redirect()->route('surat-keluar.index');
    }
}
