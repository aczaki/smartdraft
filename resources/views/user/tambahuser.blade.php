@extends('layouts.main')

@section('title','Tambah User Baru')

@section('content')
<div class="max-w-2xl mx-auto my-10">
    <div class="bg-red-600 p-4 rounded-t-lg shadow-lg">
        <h2 class="text-white font-bold text-lg uppercase tracking-wider flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            Tambah Pengguna Baru
        </h2>
    </div>

    <div class="bg-white p-8 rounded-b-lg shadow-lg border-x border-b border-gray-200">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       placeholder="Masukkan nama lengkap"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                       placeholder="Contoh: admin_imm"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border @error('username') border-red-500 @enderror">
                @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                           placeholder="••••••••"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border @error('password') border-red-500 @enderror">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Role / Hak Akses</label>
                    <select name="role" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 border">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Full Access)</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (View Only)</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('user.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">
                    Batal
                </a>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md shadow-md transition duration-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection