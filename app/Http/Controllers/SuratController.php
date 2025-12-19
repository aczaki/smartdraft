<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Services\ExtractionService;
use App\Services\TemplateSelector;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\IOFactory;

class SuratController extends Controller
{
    public function showForm()
    {
        return view('surat.form');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'text' => 'required|string'
        ]);

        $text = $request->input('text', '');

        $extract  = new ExtractionService();
        $selector = new TemplateSelector();

        // Ekstraksi lengkap
        $nomor              = $extract->extractNomor($text) ?? '---';
        // $perihal            = $extract->detectJenisSurat($text) ?? '---';
        $penerima           = $extract->extractPenerima($text) ?? '---';
        $agenda             = $extract->extractAgenda($text) ?? '---';
        $tanggal            = $extract->extractTanggal($text) ?? '---';
        $waktu              = $extract->extractWaktu($text) ?? '---';
        $tempat             = $extract->extractTempat($text) ?? '---';
        $bidang             = $extract->extractBidang($text) ?? '---';
        $ketua              = $extract->extractKetua($text) ?? '---';
        $sekretaris         = $extract->extractSekretaris($text) ?? '---';
        $penanggung_jawab   = $extract->extractPenanggungJawab($text) ?? '---';
        $tgl_dibuat         = $extract->generateTglDibuat();
        $tglHijriah         = $extract->extractTglHijriah($text)?? '---';
        $jabatan            = $extract->extractJabatan($text)?? '---';


        // Pilih template
        $templatePath = $selector->getTemplateByText($text);
        if (!$templatePath || !file_exists($templatePath)) {
            return back()->withErrors(['template' => 'Template tidak ditemukan.']);
        }

        $template = new TemplateProcessor($templatePath);
      

        // Inject value ke DOCX
        $data = [
            'nomor'       => $extract->extractNomor($text),
            'perihal'     => $extract->detectJenisSurat($text),
            'penerima'    => $extract->extractPenerima($text),
            'agenda'      => $extract->extractAgenda($text),
            'tanggal'     => $extract->extractTanggal($text),
            'tglHijriah'  => $extract->extractTglHijriah($text),
            'waktu'       => $extract->extractWaktu($text),
            'tempat'      => $extract->extractTempat($text),
            'bidang'      => $extract->extractBidang($text),
            'ketua'       => $extract->extractKetua($text),
            'sekretaris'  => $extract->extractSekretaris($text),
            'penanggung_jawab' => $extract->extractPenanggungJawab($text),
            'tgl_dibuat'  => $extract->generateTglDibuat(),
            'jabatan'     => $extract->extractJabatan($text)
        ];
        
        foreach ($data as $key => $value) {
        $template->setValue($key, $value ?? '-');
        }

        // =============================
        // SIMPAN FILE
        // =============================
        $filename = 'surat_' . $penerima . '.docx';
        $outputPath = storage_path('app/public/generated/' . $filename);

        if (!file_exists(dirname($outputPath))) {
            mkdir(dirname($outputPath), 0755, true);
        }

        $template->saveAs($outputPath);
        session([
            'preview_data' => $data,
            'preview_filename' => $filename
        ]);

        return redirect()->route('surat.preview');


    }


    public function preview()
    {
        if (!session()->has('preview_filename')) {
            return redirect()->route('surat.form');
        }

        return view('surat.preview', [
            'data' => session('preview_data'),
            'filename' => session('preview_filename')
        ]);
    }



    public function download($file)
    {
        $path = storage_path('app/generated/' . $file);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }

    public function arsip(Request $request)
    {
        $request->validate([
            'nama_surat' => 'required|string',
            'nomor_surat' => 'required|string',
            'agenda' => 'nullable|string',
            'tanggal_dibuat' => 'required|date',
            'file_path' => 'required|string'
        ]);

        ArsipSurat::create([
            'nama_surat' => $request->nama_surat,
            'nomor_surat' => $request->nomor_surat,
            'agenda' => $request->agenda,
            'tanggal_dibuat' => $request->tanggal_dibuat,
            'file_path' => $request->file_path
        ]);

        return redirect()->route('surat.preview')
            ->with('success', 'Surat berhasil diarsipkan');
    }

    
    public function inject(Request $request)
    {
        $data = $request->validate([
            'nomor' => 'required',
            'jenis_surat' => 'required',
            'penerima' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
        ]);

       $template = Template::where('keyword', $request->jenis_surat)->first();

    if (!$template) {
        return back()->withErrors([
            'jenis_surat' => 'Template tidak ditemukan'
        ]);
    }

    $templatepath = public_path($template->path_file);
    $templateProcessor = new TemplateProcessor($templatepath);

    
    // Isi template dari form
    foreach ($request->except('_token', 'jenis_surat') as $key => $value) {
        $templateProcessor->setValue($key, $value);
    }

    $filename = 'surat-'.$request->jenis_surat.'-'.'.docx';
    $path = storage_path('app/public/generated/'.$filename);

    $templateProcessor->saveAs($path);

    return response()->download($path)->deleteFileAfterSend(true);
    }
    
}
