@extends('layouts.main')

@section('title','Preview Surat')

@section('content')
<div x-data="{ open: false }" class="container mx-auto my-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white shadow-soft-xl rounded-2xl overflow-hidden border-0">
            
            <div class="p-6 border-b border-slate-100 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-red-50 text-red-600">
                        <i class='bx bx-file-find text-3xl'></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Preview Surat Digital</h2>
                        <p class="text-sm text-green-500 flex items-center gap-1">
                            <i class='bx bxs-check-circle'></i> File berhasil digenerate otomatis
                        </p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button @click="open = true" class="flex items-center gap-2 px-4 py-2 bg-slate-800 text-white rounded-xl text-sm font-bold hover:bg-slate-700 transition-all shadow-md">
                        <i class='bx bx-archive-in'></i> Arsipkan
                    </button>
                    <a href="{{ route('download.surat', $filename) }}" class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-xl text-sm font-bold hover:bg-red-700 transition-all shadow-md">
                        <i class='bx bx-download'></i> Download
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="mb-8 overflow-hidden border border-slate-100 rounded-xl">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] tracking-widest">
                            <tr>
                                <th class="px-6 py-3 border-b">Label Metadata</th>
                                <th class="px-6 py-3 border-b">Informasi Terdeteksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($data as $key => $value)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-2 font-bold text-slate-600 capitalize bg-slate-50/30 w-1/3">
                                    {{ str_replace('_',' ', $key) }}
                                </td>
                                <td class="px-4 py-2 text-slate-700">{{ $value }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="relative rounded-2xl border-4 border-slate-100 overflow-hidden shadow-inner bg-slate-200">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-red-600 z-10"></div>
                    <iframe 
                        src="https://docs.google.com/gview?url={{ asset('public/storage/generated/'.$filename) }}&embedded=true"
                        class="w-full h-[70vh] lg:h-[80vh]">
                    </iframe>
                </div>

                <div class="mt-8 flex items-center justify-between border-t border-slate-100 pt-6">
                    <a href="/surat" class="flex items-center gap-2 text-slate-500 hover:text-red-600 font-bold transition-colors">
                        <i class='bx bx-arrow-back'></i> Generate Surat Lagi
                    </a>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest">Preview Mode - Google Docs Viewer</p>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL ARSIP (Alpine.js) --}}
    <div 
        x-show="open" 
        class="fixed inset-0 z-[60] overflow-y-auto" 
        x-cloak
    >
        <div 
            x-show="open" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" 
            @click="open = false"
        ></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div 
                x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="relative w-full max-w-md transform overflow-hidden rounded-3xl bg-white p-8 shadow-2xl transition-all"
            >
                <div class="mb-6 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-50 text-red-600 mb-4">
                        <i class='bx bx-archive-in text-3xl'></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Arsipkan Surat</h3>
                    <p class="text-sm text-slate-500">Simpan metadata surat ke dalam basis data arsip digital.</p>
                </div>

                <form method="POST" action="{{ route('arsip.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="file_path" value="{{ $filename }}">

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase ml-1">Perihal</label>
                        <input type="text" name="jenis_surat" value="{{ $data['perihal'] }}" readonly
                               class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase ml-1">Nomor Surat</label>
                        <input type="text" name="nomor_surat" value="{{ $data['nomor'] }}" readonly
                               class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase ml-1">Penerima</label>
                        <input type="text" name="penerima" value="{{ $data['penerima'] }}" 
                               class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase ml-1">Pembuat</label>
                        <input type="text" name="pembuat" value="{{ $data['bidang'] }}" 
                               class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500 uppercase ml-1">Agenda</label>
                            <input type="text" name="agenda" value="{{ $data['agenda'] }}" readonly
                            class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500 uppercase ml-1">Tanggal Dibuat</label>
                            <input type="text" name="tanggal_dibuat" value="{{ $data['tgl_dibuat'] }}" readonly
                                   class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                        </div>
                    </div>
                    <div class="pt-4 flex gap-3">
                        <button type="button" @click="open = false" 
                                class="flex-1 px-4 py-3 border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 px-4 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 shadow-lg shadow-red-200 transition-all">
                            Simpan Arsip
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
