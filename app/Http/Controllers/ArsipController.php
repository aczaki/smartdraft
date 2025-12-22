<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSurat;
use App\Exports\ArsipExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ArsipController extends Controller
{
    public function arsip(Request $request)
    {
        
        ArsipSurat::create($request->all());
        return redirect()->route('surat.preview')
            ->with('success', 'Surat berhasil diarsipkan');
    }

    public function dashboard()
    {
        $totalArsip = ArsipSurat::count();

        return view('dashboard', compact('totalArsip'));
    }

    public function arsipStore(Request $request)
    {
        return view('surat.arsiptambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat'  => 'required|string',
            'nomor_surat' => 'required|string',
            'penerima' => 'required|string',
            'agenda'      => 'required|string',
            'tanggal_dibuat'  => 'required|string',
            'pembuat'     => 'required|string',
            'file_path' => 'string',
        ]);
        // dd($request->all());
        ArsipSurat::create($request->all());

        return redirect()->back()
            ->with('success', 'Surat berhasil diarsipkan');
    }

    public function show(Request $request)
    {
        $arsip = ArsipSurat::all();
        $totalArsip = ArsipSurat::count();
        return view('surat.arsip', compact('arsip', 'totalArsip'));
    }

    public function edit($id)
    {
        $arsip = ArsipSurat::findOrFail($id);
        return view('surat.arsip-edit', compact('arsip'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_surat'  => 'required',
            'nomor_surat' => 'required',
            'penerima' => 'required',
            'agenda'      => 'required',
            'tanggal_dibuat'  => 'required',
            'pembuat'     => 'required'
        ]);

        $arsip = ArsipSurat::findOrFail($id);
        $arsip->update($request->all());

        return redirect()->route('arsip.index')
            ->with('success', 'Arsip berhasil diperbarui');
    }

    public function destroy($id)
    {
        ArsipSurat::findOrFail($id)->delete();

        return redirect()->route('arsip.index')
            ->with('success', 'Arsip berhasil dihapus');
    }

    public function exportPdf()
    {
        // 1. Ambil data dari database
        $arsip = ArsipSurat::all();

        // 2. Load view dan masukkan data
        $pdf = Pdf::loadView('pdf.arsippdf', compact('arsip'));

        // Opsional: Atur ke Landscape jika kolomnya banyak
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-arsip-surat.pdf');
    }


}
