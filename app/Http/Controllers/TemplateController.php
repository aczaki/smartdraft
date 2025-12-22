<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;

class TemplateController extends Controller
{
    public function index()
    {
        return view('template.uplTemplate');
    }

    public function upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_surat' => 'required|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'template_file' => 'required|mimes:docx',
        ]);

        // dd($request);
        // Upload file
        $file = $request->file('template_file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Simpan ke folder public/templates/
        $file->move(public_path('templates'), $filename);

        // Simpan ke database
        Template::create([
            'jenis_surat' => $request->jenis_surat,
            'keyword' => $request->keyword,
            'path_file' => 'templates/' . $filename
        ]);

        

        return redirect()->route('templates.index')->with('success', 'Template berhasil diupload!');
    }

    public function showTemplate(){
        
        $templates = Template::all();
        return view('template.list', compact('templates'));
    }

    public function edit($id)
    {
        $template = Template::findOrFail($id);
        return view('template.edit', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $template = Template::findOrFail($id);
        $template->jenis_surat = $request->jenis_surat;
        $template->keyword = $request->keyword;
        $template->path_file = $request->path_file;
        $template->save();

        return redirect()->route('templates.index')->with('success', 'Template berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $template = Template::findOrFail($id);

        // hapus file fisik di storage/app/public/templates
        if ($template->file && Storage::disk('public')->exists('templates/' . $template->file)) {
            Storage::disk('public')->delete('templates/' . $template->file);
        }

        // hapus data di database
        $template->delete();

        return redirect()
            ->route('templates.index')
            ->with('success', 'Template dan file berhasil dihapus.');
    }

}
