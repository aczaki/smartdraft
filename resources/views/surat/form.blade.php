@extends('layouts.main')

@section('title', 'Buat Surat')

@section('content')
<div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
   <div class="lg:col-span-4 space-y-4 lg:sticky lg:top-8">
    <div class="bg-white rounded-2xl p-6 shadow-soft-xl border border-slate-100">
        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-50">
            <i class='bx bx-file-find text-xl text-red-500'></i>
            <div>
                <h3 class="font-bold text-slate-800 text-sm">Contoh Penulisan</h3>
                <p class="text-[10px] text-slate-400">Pilih jenis untuk melihat contoh</p>
                <p class="text-[10px] text-red-600 leading-tight italic mt-1">
                    <strong></strong>*Wajib menggunakan contoh penulisan agar sistem dapat melakukan ekstraksi dengan baik.
                </p>
            </div>
        </div>

        <div class="relative mb-4">
            <select id="draft-selector" onchange="updateDraftView()" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-[11px] font-bold text-slate-700 outline-none focus:border-red-500 transition-all appearance-none cursor-pointer uppercase tracking-tight">
                <option value="" disabled selected>-- Pilih Jenis Surat --</option>
                <option value="undangan">SURAT UNDANGAN</option>
                <option value="tempat">PEMINJAMAN TEMPAT</option>
                <option value="pembicara">PERMOHONAN PEMBICARA</option>
                <option value="pemberitahuan">PEMBERITAHUAN</option>
                <option value="alat">PEMINJAMAN ALAT</option>
                <option value="aktif">KETERANGAN AKTIF</option>
            </select>
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                <i class='bx bx-chevron-down text-lg'></i>
            </div>
        </div>

        <div id="draft-display" class="hidden animate-fade-in">
            <div class="bg-slate-50 rounded-xl border border-dashed border-slate-200 p-4 relative group">
                <div class="flex justify-end mb-2">
                    <button id="btn-copy" onclick="copyDraft()" class="text-[10px] font-bold text-red-500 hover:text-red-700 flex items-center gap-1 transition-all duration-200">
                        <i class='bx bx-copy-alt'></i> SALIN TEKS
                    </button>
                </div>
                <p id="draft-text" class="text-[11px] text-slate-500 italic leading-relaxed">
                    </p>
            </div>
        </div>

        <div id="draft-placeholder" class="py-10 text-center border-2 border-dashed border-slate-50 rounded-xl transition-all">
            <i class='bx bx-mouse-alt text-3xl text-slate-200 mb-2'></i>
            <p class="text-[10px] text-slate-400 px-4">Pilih jenis surat untuk melihat referensi</p>
        </div>

        <div class="mt-6 p-3 bg-red-50/50 rounded-xl border border-red-100">
            <p class="text-[10px] text-red-600 leading-tight italic">
                <strong>Tips:</strong> Setelah menyalin, tempelkan teks ke kolom input di samping dan edit data sesuai kebutuhan.
                
            </p>
        </div>
    </div>
</div>

<script>
    const draftData = {
        undangan: "surat undangan nomor surat: 19/A-9/XI/2023 kepada Endah Sudarmilah, S.Kom, M.Kom. untuk menghadiri agenda: Pelantikan, pada Sabtu, 25 September 2025 bertepatan dengan 13 Rajab 1447 H pukul 19.00-selesai di Gedung Jseminar 2 . oleh Bidang Organisasi. ketua IMMawan Achmad Zaki Ramadani, sekretaris IMMawan Hammam Dzaki, penanggung jawab IMMawan Yakub Firman Mustofa.",
        tempat: "surat peminjaman tempat nomor: 20/A-9/XI/2025 kepada TU FKI UMS. untuk agenda: Rapat kerja, pada 25 September 2025 bertepatan dengan 13 Rabiul Awal 1447 H pukul 19.00-21.00 WIB di Gedung JSeminar 2. Oleh bidang Kader. ketua IMMawan Achmad Zaki Ramadani, sekretaris IMMawan Hammam Dzaki, penanggung jawab IMMawan Yakub Firman Mustofa",
        pembicara: "surat permohonan pembicara nomor: 20/A-9/XI/2025 kepada IMMawan Rifan Ardiansyah untuk agenda: Ruang Media, pada Sabtu, 25 Januari 2026 bertepatan dengan 13 Rajab 1447 H pukul 19.00 di Gedung JSeminar 2. oleh Bidang Media dan Komunikasi. ketua IMMawan Achmad Zaki Ramadani, sekretaris IMMawan Hammam Dzaki, penanggung jawab IMMawan Yakub Firman Mustofa",
        pemberitahuan: "surat pemberitahuan nomor: 20/A-9/XI/2025 kepada IMMawan Rifan Ardiansyah untuk agenda: Ruang Media, pada Sabtu, 25 Januari 2026 bertepatan dengan 13 Rajab 1447 H pukul 19.00 di Gedung JSeminar 2. oleh Bidang Media dan Komunikasi. ketua IMMawan Achmad Zaki Ramadani, sekretaris IMMawan Hammam Dzaki, penanggung jawab IMMawan Yakub Firman Mustofa",
        alat: "surat peminjaman alat nomor: 41/C-1/XI/2025 kepada FOSTI UMS untuk agenda: Darul Arqam Dasar (DAD), pada Sabtu-Selasa, 12-14 Desember 2025 bertepatan dengan 1 Rajab 1447 H pukul 09.00-selesai di Sribit, Delanggu, Klaten. oleh Bidang Kader. ingin meminjam 1 buah mixer. Ketua IMMawan Hammam Dzaki, sekretaris IMMawati Kurnia, penanggung jawab IMMawan Rifat Akhtar",
        aktif: "surat keterangan aktif nomor: 017/C-1/XI/2025 kepada Yakub Firman Mustofa dengan jabatan Sebagai Anggota Bidang Kader Pimpinan Komisariat Adam Malik FKI UMS periode 2023/2024. bertepatan dengan 13 Syawal 1446 H. oleh Pimpinan. ketua IMMawan Rifat Akhtar Rajwa, sekretaris IMMawan Ammar Miftahudin Anshori"
    };

    function updateDraftView() {
        const selector = document.getElementById('draft-selector');
        const display = document.getElementById('draft-display');
        const placeholder = document.getElementById('draft-placeholder');
        const textField = document.getElementById('draft-text');

        if (selector.value) {
            textField.innerText = draftData[selector.value];
            display.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    }

    function copyDraft() {
    const text = document.getElementById('draft-text').innerText;
    const btn = document.getElementById('btn-copy');
    const originalHTML = btn.innerHTML;

    // Fungsi untuk mengubah UI saat sukses
    const showSuccess = () => {
        btn.innerHTML = "<i class='bx bx-check'></i> TERSALIN!";
        btn.classList.replace('text-red-500', 'text-green-600');
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.replace('text-green-600', 'text-red-500');
        }, 2000);
    };

    // Metode 1: Clipboard API (Modern & HTTPS)
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(showSuccess).catch(err => {
            fallbackCopyTextToClipboard(text, showSuccess);
        });
    } else {
        // Metode 2: Fallback (Untuk Mobile/HTTP)
        fallbackCopyTextToClipboard(text, showSuccess);
    }
}

// Fungsi Fallback menggunakan TextArea tersembunyi
    function fallbackCopyTextToClipboard(text, callback) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        
        // Pastikan textarea tidak terlihat dan tidak merusak scroll
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";
        textArea.style.opacity = "0";

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        textArea.setSelectionRange(0, 99999); // Untuk iOS

        try {
            const successful = document.execCommand('copy');
            if (successful) callback();
        } catch (err) {
            console.error('Gagal menyalin teks', err);
        }

        document.body.removeChild(textArea);
    }
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
</style>



        <div class="lg:col-span-8">
            <div class="bg-white overflow-hidden shadow-soft-xl rounded-2xl border-0">
                
                <div class="p-6 pb-0 bg-white">
                    <div class="flex items-center gap-3 mb-1">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-red-50 text-red-600">
                            <i class='bx bx-wand text-2xl'></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">Ekstraksi Surat Otomatis</h2>
                            <p class="text-sm text-slate-500">Sistem akan mendeteksi informasi penting secara otomatis.</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="/generate-surat" enctype="multipart/form-data" class="p-6 mt-2">
                    @csrf

                    <div class="relative group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Teks Input / Draft Surat</label>
                        <textarea 
                            name="text" 
                            rows="10" 
                            class="w-full p-4 text-slate-700 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                            placeholder="Tulis atau tempel draft teks naratif Anda di sini..."
                            required
                        ></textarea>
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2 text-xs text-slate-400 italic">
                            <i class='bx bx-info-circle text-sm'></i>
                            Tekan tombol di samping untuk memproses dokumen.
                        </div>

                        <button type="submit" 
                            class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-red-700 to-red-500 rounded-xl cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:shadow-soft-2xl active:opacity-85 active:scale-95">
                            <i class='bx bx-cog bx-spin-hover text-sm'></i>
                            <span>Proses & Generate Surat</span>
                        </button>
                    </div>
                </form>

                <div class="bg-slate-50/50 p-4 border-t border-slate-100">
                    <div class="flex items-center justify-center gap-6">
                        <div class="flex items-center gap-1 text-[10px] text-slate-400 uppercase tracking-tighter">
                            <i class='bx bx-check-shield text-red-500'></i> Secure Processing
                        </div>
                        <div class="flex items-center gap-1 text-[10px] text-slate-400 uppercase tracking-tighter">
                            <i class='bx bx-file-blank text-red-500'></i> DOCX Output
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection