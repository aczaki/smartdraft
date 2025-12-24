@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8">
    
    <div class="flex flex-wrap -mx-3 mb-8">
        <div class="w-full px-3">
            <div class="relative overflow-hidden bg-gradient-to-r from-red-700 to-red-500 rounded-3xl p-8 shadow-soft-xl">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 opacity-10">
                    <i class='bx bxs-envelope text-[200px] text-white'></i>
                </div>
                
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang di Sistem Surat Digital</h1>
                    <p class="text-red-100 max-w-2xl leading-relaxed">
                        Platform otomasi manajemen persuratan yang dirancang untuk efisiensi ekstraksi data dan pengarsipan digital berbasis ekstraksi informasi (Regex).
                    </p>
                </div>
            </div>
        </div>
    </div>
<div class="flex flex-wrap -mx-3 mb-8">
    <div class="w-full px-3">
        <div class="bg-white rounded-2xl p-5 shadow-soft-xl border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
            
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex w-12 h-12 bg-red-50 text-red-600 rounded-xl items-center justify-center flex-shrink-0 text-2xl">
                    <i class='bx bxs-paper-plane'></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800 leading-tight">Mulai Buat Surat Baru</h2>
                    <p class="text-xs text-slate-500">Pilih metode pembuatan surat yang Anda butuhkan saat ini.</p>
                </div>
            </div>
            
            <div class="flex gap-3 w-full md:w-auto">
                <a href="{{ route('surat.form') }}" class="flex-1 md:flex-none flex items-center justify-center gap-2 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow-md transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
                    <i class='bx bxs-magic-wand text-sm'></i>
                    <span class="font-bold text-xs uppercase tracking-wide">Otomatis</span>
                </a>
                
                <a href="{{ route('surat.based') }}" class="flex-1 md:flex-none flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-700 rounded-xl transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
                    <i class='bx bxs-edit-alt text-sm'></i>
                    <span class="font-bold text-xs uppercase tracking-wide">Manual</span>
                </a>
            </div>

        </div>
    </div>
</div>
    <div class="flex flex-wrap -mx-3">
        <div class="w-full lg:w-8/12 px-3 mb-6">
            <div class="bg-white rounded-3xl p-6 shadow-soft-xl border border-slate-100 h-full">
                <div class="flex items-center gap-3 mb-6 border-b border-slate-50 pb-4">
                    <div class="p-3 bg-red-50 text-red-600 rounded-2xl">
                        <i class='bx bx-info-circle text-2xl'></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Tentang Sistem</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="text-red-500 mt-1"><i class='bx bxs-zap text-xl'></i></div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Otomasi Sederhana</h4>
                                <p class="text-xs text-slate-500 leading-normal">Mengekstrak informasi penting dari teks naratif menggunakan Regex secara sederhana.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="text-red-500 mt-1"><i class='bx bxs-file-doc text-xl'></i></div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Format Standar (.docx)</h4>
                                <p class="text-xs text-slate-500 leading-normal">Menghasilkan dokumen surat resmi dalam format Microsoft Word.</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="text-red-500 mt-1"><i class='bx bxs-archive text-xl'></i></div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Arsip Terpusat</h4>
                                <p class="text-xs text-slate-500 leading-normal">Penyimpanan arsip digital yang rapi dan terintegrasi dengan database sistem.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="text-red-500 mt-1">
                                <i class='bx bxs-file-pdf text-2xl'></i>
                            </div>
                            
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Export Arsip</h4>
                                <p class="text-xs text-slate-500 leading-normal">
                                    Menyediakan kemampuan untuk mengekspor dokumen arsip surat ke format PDF.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-4/12 px-3 space-y-6">
            
            <div class="group relative bg-slate-900 rounded-3xl p-6 shadow-soft-2xl border border-slate-800 overflow-hidden transition-all duration-300 hover:-translate-y-2">
                <div class="absolute top-0 right-0 p-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                    <i class='bx bxs-book-bookmark text-8xl text-white'></i>
                </div>
                
                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-white mb-2">Buku Panduan</h3>
                    <p class="text-slate-400 text-xs leading-relaxed mb-6">
                        Pelajari cara menggunakan sistem, manajemen template, hingga tips ekstraksi teks yang optimal.
                    </p>
                    <a href="https://drive.google.com/drive/folders/14sUXuRHyarLsnW3zhBS_Cm7jDsedTMyu?usp=sharing" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-red-900/40">
                        Buka Panduan <i class='bx bx-right-arrow-alt text-lg'></i>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-soft-xl border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Arsip</p>
                    <h2 class="text-3xl font-black text-slate-800">{{ $totalArsip ?? 0 }}</h2>
                </div>
                <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-inner">
                    <i class='bx bxs-cabinet text-3xl'></i>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
