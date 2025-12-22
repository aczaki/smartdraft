@extends('layouts.main')

@section('title','Edit Pengguna')

@section('content')
<div class="max-w-2xl mx-auto my-10">
    <div class="bg-red-600 p-4 rounded-t-lg shadow-lg">
        <h2 class="text-white font-bold text-lg uppercase tracking-wider flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Edit Data & Reset Password
        </h2>
    </div>

    <div class="bg-white p-8 rounded-b-lg shadow-lg border-x border-b border-gray-200">
        <form method="POST" action="{{ route('user.update', $user->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full border-gray-300 rounded-md px-3 py-2 border focus:ring-red-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                           class="w-full border-gray-300 rounded-md px-3 py-2 border focus:ring-red-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1 text-red-600">Password Baru</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter"
                           class="w-full border-red-300 rounded-md px-3 py-2 border focus:ring-red-500 @error('password') border-red-500 @enderror">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required placeholder="Ketik ulang password"
                           class="w-full border-gray-300 rounded-md px-3 py-2 border focus:ring-red-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Role</label>
                <select name="role" required class="w-full border-gray-300 rounded-md px-3 py-2 border focus:ring-red-500">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('user.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">Batal</a>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md shadow-md transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Perbarui Data & Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection