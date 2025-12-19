@extends('layouts.main')

@section('title', 'Form Based')

@section('content')


<div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-lg rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-indigo-600 px-6 py-4">
            <h3 class="text-xl font-bold text-white">Generate Surat Digital</h3>
            <p class="text-indigo-100 text-sm">Lengkapi data di bawah untuk membuat surat otomatis</p>
        </div>

        <form action="{{ route('surat.inject') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Surat</label>
                <input type="text" name="nomor" placeholder="Contoh: 001/UN/2025" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Surat</label>
                <div class="relative">
                    <select name="jenis_surat" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg appearance-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200 bg-white">
                        <option value="" disabled selected>Pilih jenis surat...</option>
                        <option value="undangan">✉️ Undangan</option>
                        <option value="tugas">📋 Tugas</option>
                        <option value="pemberitahuan">📢 Pemberitahuan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Penerima</label>
                <input type="text" name="penerima" placeholder="Nama instansi atau perorangan" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tempat Acara</label>
                    <input type="text" name="tempat" placeholder="Lokasi kegiatan" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu Acara</label>
                    <input type="text" name="waktu" placeholder="Contoh: 09:00 WIB" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200 flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    <span>Generate Surat Sekarang</span>
                </button>
            </div>
        </form>
        
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
            <p class="text-xs text-center text-gray-500 italic">Pastikan data yang dimasukkan sudah benar sebelum menekan tombol generate.</p>
        </div>
    </div>
</div>

@endsection