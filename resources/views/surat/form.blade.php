
@extends('layouts.main')

@section('title', 'Buat Surat')

@section('content')
<div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-soft-xl rounded-2xl border-0">
            
            <div class="p-6 pb-0 bg-white">
                <div class="flex items-center gap-3 mb-1">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-red-50 text-red-600">
                        <i class='bx bx-wand text-2xl'></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Ekstraksi Surat Otomatis</h2>
                        <p class="text-sm text-slate-500">Sistem akan mendeteksi informasi penting dan memilih template yang sesuai secara otomatis.</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="/generate-surat" enctype="multipart/form-data" class="p-6 mt-2">
                @csrf

                <div class="relative group">
                    <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Teks Input / Draft Surat</label>
                    <textarea 
                        name="text" 
                        rows="8" 
                        class="w-full p-4 text-slate-700 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 focus:bg-white outline-none transition-all duration-300 placeholder:text-slate-400"
                        placeholder="Contoh: Undangan rapat koordinasi pada tanggal 20 Desember di Ruang Media..."
                        required
                    ></textarea>
                    
                    <div class="absolute bottom-4 right-4 flex items-center gap-2 text-slate-300 pointer-events-none">
                        <span class="text-[10px] uppercase font-bold tracking-widest">Auto-Detection Ready</span>
                        <i class='bx bx-scan text-xl'></i>
                    </div>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-xs text-slate-400 italic">
                        <i class='bx bx-info-circle text-sm'></i>
                        Gunakan bahasa yang jelas untuk hasil ekstraksi maksimal.
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


@endsection
