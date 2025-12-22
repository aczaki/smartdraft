@extends('layouts.main')

@section('title', 'Edit Template')

@section('content')
<div class="max-w-2xl mx-auto my-10">
    <div class="bg-red-600 p-4 rounded-t-lg shadow-lg">
        <h2 class="text-white font-bold text-lg uppercase tracking-wider flex items-center">
            <i class='bx bxs-edit-alt mr-2'></i> Edit Template Dokumen
        </h2>
    </div>

    <div class="bg-white p-8 rounded-b-lg shadow-lg border-x border-b border-gray-200">
        <form action="{{ route('templates.update', $template->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Surat</label>
                <input type="text" 
                       name="jenis_surat" 
                       value="{{ old('jenis_surat', $template->jenis_surat) }}" 
                       required
                       placeholder="Contoh: Surat Keterangan Aktif Kuliah"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border transition">
                <p class="text-xs text-slate-500 mt-1 italic">Nama resmi yang akan muncul di judul laporan/arsip.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Keyword (Sistem)</label>
                <input type="text" 
                       name="keyword" 
                       value="{{ old('keyword', $template->keyword) }}" 
                       required
                       placeholder="Contoh: sk-aktif-kuliah"
                       class="w-full bg-gray-50 border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border transition">
                <p class="text-xs text-amber-600 mt-1 italic font-medium">Hati-hati: Mengubah keyword dapat mempengaruhi pemanggilan file template di sistem.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Path File</label>
                <input type="text" 
                       name="path_file" 
                       value="{{ $template->path_file }}" 
                       readonly
                       class="w-full bg-gray-100 border-gray-300 rounded-md px-3 py-2 border text-gray-500 text-sm cursor-not-allowed">
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('templates.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">Batal</a>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md shadow-md transition flex items-center font-semibold">
                    <i class='bx bxs-save mr-2'></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection