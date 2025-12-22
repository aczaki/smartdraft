@extends('layouts.main')

@section('title','Tambah Arsip')

@section('content')
<div class="max-w-3xl mx-auto my-10">
    <div class="bg-red-600 p-4 rounded-t-lg shadow-lg">
        <h2 class="text-white font-bold text-lg uppercase tracking-wider flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Tambah Arsip Surat
        </h2>
    </div>

    <div class="bg-white p-8 rounded-b-lg shadow-lg border-x border-b border-gray-200">
        <form method="POST" action="{{ route('arsip.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Surat</label>
                    <input type="text" name="jenis_surat"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Surat</label>
                    <input type="text" name="nomor_surat"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border font-mono">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Penerima</label>
                <input type="text" name="penerima"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Agenda / Perihal</label>
                <textarea name="agenda" rows="3"
                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Dibuat</label>
                    <input type="text" name="tanggal_dibuat"
                           class="w-full bg-gray-50 border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border">
                    <small class="text-gray-400 text-xs mt-1">*Format: 20 Desember 2025 M</small>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Pembuat</label>
                    <input type="text" name="pembuat"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border">
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('arsip.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">
                    Batal
                </a>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md shadow-md transition duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Tambah Arsip
                </button>
            </div>
        </form>
    </div>
</div>
@endsection