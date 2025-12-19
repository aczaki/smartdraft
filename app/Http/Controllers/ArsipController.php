<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSurat;
use App\Exports\ArsipExport;
use Maatwebsite\Excel\Facades\Excel;

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
        // Jika Anda punya model Template dan User, tambahkan juga:
        // $totalTemplate = \App\Models\Template::count();
        // $totalUser = \App\Models\User::count();

        return view('dashboard', compact('totalArsip'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_surat'  => 'required|string',
            'nomor_surat' => 'required|string',
            'agenda'      => 'required|string',
            'tanggal_dibuat'  => 'required|string',
            'pembuat'     => 'required|string',
            'file_path' => 'required|string',
        ]);
        // dd($request->all());
        ArsipSurat::create($request->all());

        return redirect()->back()
            ->with('success', 'Surat berhasil diarsipkan');
    }

    public function show(Request $request)
    {
        $arsip = ArsipSurat::all();
        return view('surat.arsip', compact('arsip'));
    }

    public function edit($id)
    {
        $arsip = ArsipSurat::findOrFail($id);
        return view('surat.arsip-edit', compact('arsip'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_surat' => 'required',
            'agenda' => 'required'
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

    public function export()
    {
        return Excel::download(new ArsipExport, 'arsip.xlsx');
    }


}
