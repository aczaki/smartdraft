@extends('layouts.main')

@section('title', 'Preview')

@section('content')
{{-- Bungkus dengan x-data Alpine.js untuk kontrol modal --}}
<div x-data="{ showModal: false }" class="min-h-screen bg-gray-100 p-6 flex flex-col items-center">
    
    <div class="bg-white w-full max-w-4xl rounded-xl shadow-lg overflow-hidden">
        <div class="bg-slate-800 px-6 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold">Preview Surat</h3>
            <div class="flex gap-2 items-center">
                <a href="{{ route('surat.based') }}" class="text-slate-300 hover:text-white text-sm px-3 py-2">Batal</a>
                
                {{-- Tombol Arsipkan (Membuka Modal) --}}
                <button @click="showModal = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition">
                    <i class="bx bx-archive-in"></i> Arsipkan
                </button>

                <a href="{{ route('surat.download.direct', $filename) }}"  
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition">
                    <i class="bx bx-download"></i> Download
                </a>
            </div>
        </div>

        <div class="p-4 bg-gray-200 h-[600px]">
            <iframe 
                src="https://docs.google.com/gview?url={{ asset('temp_generated/' . $filename) }}&embedded=true" 
                class="w-full h-full rounded border shadow-inner"
                frameborder="0">
            </iframe>
        </div>

        <div class="p-4 border-t text-center bg-gray-50">
            <p class="text-sm text-gray-500 italic">Jika preview tidak muncul, pastikan koneksi internet stabil atau klik tombol download.</p>
        </div>
    </div>

    {{-- MODAL POPUP --}}
    <div 
        x-show="showModal" 
        class="fixed inset-0 z-[99] flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto"
        x-cloak
    >
        {{-- Overlay Backdrop --}}
        <div 
            x-show="showModal" 
            x-transition.opacity 
            @click="showModal = false" 
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        ></div>

        {{-- Konten Modal --}}
        <div 
            x-show="showModal" 
            class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 text-left"
            @click.away="showModal = false"
        >
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                    <i class="bx bx-archive-in text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Konfirmasi Arsip</h3>
                    <p class="text-sm text-slate-500">Periksa kembali data surat sebelum disimpan.</p>
                </div>
            </div>
            <form method="POST" action="{{ route('arsip.store') }}" class="space-y-4">
                    @csrf
                    
                    <input type="hidden" name="file_path" value="{{ $filename }}">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase ml-1">Perihal</label>
                        <input type="text" name="jenis_surat" value="{{ session('preview_data.jenis_surat') }}" readonly
                               class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase ml-1">Nomor Surat</label>
                        <input type="text" name="nomor_surat" value="{{ session('preview_data.nomor') }}" readonly
                               class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase ml-1">Penerima</label>
                        <input type="text" name="penerima" value="{{ session('preview_data.penerima') }}" 
                               class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase ml-1">Pembuat</label>
                        <input type="text" name="pembuat" value="{{ session('preview_data.bidang') }}" 
                               class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500 uppercase ml-1">Agenda</label>
                            <input type="text" name="agenda" value="{{ session('preview_data.agenda') }}" readonly
                            class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed italic">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500 uppercase ml-1">Tanggal Dibuat</label>
                            <input type="text" name="tanggal_dibuat" value="{{ session('preview_data.tgl_dibuat') }}" readonly
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

{{-- Tambahkan CSS x-cloak agar modal tidak muncul sekilas saat refresh --}}
<style>
    [x-cloak] { display: none !important; }
</style>
@endsection