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
use Carbon\Carbon;

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
        $alat               = $extract->extractAlat($text) ?? '---';


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
            'jabatan'     => $extract->extractJabatan($text),
            'alat'        => $extract->extractAlat($text),
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

        return redirect()->route('surat.preview')->with('success', 'Surat berhasil dibuat!');


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

    // Formulir
   public function inject(Request $request)
   {
        $data = $request->validate([
            'nomor' => 'required',
            'jenis_surat' => 'required',
            'penerima' => 'required',
            'agenda' => 'required',
            'tanggal'=> 'required',
            'tglHijriah' => 'required',
            'tgl_dibuat' => 'required|date',
            'bidang' => 'required', 
            'ketua' => 'required',
            'sekretaris' => 'required',
            'penanggung_jawab' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
            'alat' => 'nullable',
        ]);


        $template = Template::where('keyword', $request->jenis_surat)->first();

        $bulan = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $tglParts = explode('-', $request->tgl_dibuat);
        $tglWithM = $tglParts[2] . ' ' . $bulan[$tglParts[1]] . ' ' . $tglParts[0] . ' M';

        $data['tgl_dibuat'] = $tglWithM;

        if (!$template) {
            return back()->withErrors(['jenis_surat' => 'Template tidak ditemukan']);
        }

        $templatepath = public_path($template->path_file);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatepath);

        $templateProcessor->setValue('tgl_dibuat', $tglWithM);


        // Isi template
        foreach ($request->except('_token', 'jenis_surat') as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

        // Buat nama file unik agar tidak bentrok antar user
        $filename = 'surat-' . $data['penerima'] . '-' . date('Y-m-d') . '.docx';
        $directory = public_path('temp_generated');
        
        // Pastikan folder ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $filename;
        $templateProcessor->saveAs($path);

        session([
            'preview_data' => $data,
            'preview_filename' => $filename
        ]);

        // Kirim data ke session untuk digunakan di halaman preview
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat!');
    }

    public function prebased()
    {
        if (!session()->has('preview_filename')) {
            return redirect()->route('surat.form');
        }

        return view('surat.prebased', [
            'data' => session('preview_data'),
            'filename' => session('preview_filename')
        ]);
    }
    
}
