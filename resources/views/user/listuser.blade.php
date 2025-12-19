@extends('layouts.main')

@section('title', 'Daftar Pengguna')

@section('content')

<div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8">
    <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <div class="flex flex-wrap -mx-3">
                <div class="flex items-center flex-none w-full max-w-full px-3 py-2 sm:w-1/2">
                    <div>
                        <h3 class="mb-0 text-xl font-bold text-slate-800">Manajemen Pengguna</h3>
                        <p class="text-sm leading-normal text-slate-500">Kelola akses dan otoritas akun sistem</p>
                    </div>
                </div>
                <div class="flex-none w-full max-w-full px-3 py-2 text-right sm:w-1/2">
                    <button class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-slate-800 to-slate-700 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:shadow-soft-2xl active:opacity-85">
                        <i class='bx bx-user-plus mr-1'></i> Tambah Pengguna
                    </button>
                </div>
            </div>
        </div>

        <div class="flex-auto px-0 pt-0 pb-2 mt-4">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-slate-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Profil Pengguna</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Username</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Role / Hak Akses</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $index => $u)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="px-4 py-1 text-center">
                                    <p class="mb-0 text-sm font-semibold leading-normal text-slate-700">{{ $index + 1 }}</p>
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1 items-center">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm font-bold leading-normal text-slate-800">{{ $u->name }}</h6>
                                        <p class="mb-0 text-xs leading-tight text-slate-400">Account Verified</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="px-3 py-1 text-sm font-medium text-slate-600">
                                    {{ $u->username }}
                                </span>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="px-4 py-1 text-[10px] font-bold rounded-xl uppercase tracking-wider
                                    {{ $u->role == 'admin' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                    {{ $u->role }}
                                </span>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('user.edit', $u->id ) }}" class="text-blue-500 hover:text-blue-700 transition-all text-xl" title="Edit Pengguna">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    
                                    <form action="{{ route('user.delete', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus pengguna ini?')" class="text-red-500 hover:text-red-700 transition-all text-xl" title="Hapus Pengguna">
                                            <i class='bx bx-trash-alt'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-between p-6 border-t border-slate-100">
            <span class="text-sm font-normal text-slate-500 italic">
                Total terdaftar: <span class="font-bold text-slate-800">{{ $user->count() }}</span> Akun
            </span>
            <div class="inline-flex gap-2">
                <button class="px-4 py-2 text-xs font-semibold border rounded-lg border-slate-200 text-slate-600 hover:bg-slate-50 transition-all">Previous</button>
                <button class="px-4 py-2 text-xs font-semibold border rounded-lg border-slate-200 text-slate-600 hover:bg-slate-50 transition-all">Next</button>
            </div>
        </div>
    </div>
</div>

@endsection
