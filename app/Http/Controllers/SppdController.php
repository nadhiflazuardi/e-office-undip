<?php

namespace App\Http\Controllers;

use App\Http\Requests\SppdRequest;
use App\Models\PerjalananDinas;
use Illuminate\Http\Request;

class SppdController extends Controller
{
    public function index()
    {
        $title = 'SPPD';
        return view('sppd.index', compact('title'));
    }

    public function create()
    {
        $title = 'Buat SPPD';
        return view('sppd.create', compact('title'));
    }

    public function store(SppdRequest $request)
    {
        $validated = $request->validated();

        try {
            // Generate PDF
            // $pdf = Pdf::loadView('pdf.sppd', $validated);
            $pdfPath = 'sppd/' . uniqid() . '.pdf';
            // $pdf->save(storage_path('app/' . $pdfPath));

            // Save the path to the validated data
            $validated['file_sppd'] = $pdfPath;

            // Save to database
            PerjalananDinas::create($validated);

            return redirect()->route('sppd.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }

    public function show(PerjalananDinas $sppd)
    {
        $title = 'Detail SPPD';
        return view('sppd.show', compact('title', 'sppd'));
    }

    public function edit(PerjalananDinas $sppd)
    {
        $title = 'Edit SPPD';
        return view('sppd.edit', compact('title', 'sppd'));
    }

    public function update(SppdRequest $request, PerjalananDinas $sppd)
    {
        $validated = $request->validated();

        try {
            // Generate PDF
            // $pdf = Pdf::loadView('pdf.sppd', $validated);
            $pdfPath = 'sppd/' . uniqid() . '.pdf';
            // $pdf->save(storage_path('app/' . $pdfPath));

            // Save the path to the validated data
            $validated['file_sppd'] = $pdfPath;

            // Save to database
            $sppd->update($validated);

            return redirect()->route('sppd.index')->with('success', 'Data berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data. Silakan coba lagi.');
        }
    }

    public function destroy(PerjalananDinas $sppd)
    {
        try {
            $sppd->delete();
            return redirect()->route('sppd.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }
}
