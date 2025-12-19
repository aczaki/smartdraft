@extends('layouts.main')

@section('title', 'Arsip Surat')

@section('content')

<div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8">
    <div class="relative flex flex-col w-full min-w-0 mb-6 bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        
        <div class="p-6 pb-0 mb-0 bg-red-600 rounded-t-2xl">
            <div class="flex flex-wrap -mx-3">
                <div class="flex items-center flex-none w-full max-w-full px-3 py-2 sm:w-1/2">
                    <div>
                        <h3 class="mb-0 text-xl font-bold text-white">Daftar Arsip Surat</h3>
                        <p class="text-sm leading-normal text-slate-100">Kelola dan pantau arsip digital Anda</p>
                    </div>
                </div>
                <div class="flex-none w-full max-w-full px-3 py-2 text-right sm:w-1/2">
                    <a href="{{ route('arsip.export') }}" 
                       class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-slate-800 to-slate-700 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:shadow-soft-2xl active:opacity-85">
                        <i class='bx bxs-file-export mr-1'></i> Export Arsip
                    </a>
                </div>
            </div>
        </div>

        <div class="flex-auto px-0 pt-0 pb-2 mt-4">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-slate-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Informasi Surat</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Agenda</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Dibuat</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-slate-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arsip as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="px-4 py-1">
                                    <p class="mb-0 text-sm font-semibold leading-normal text-slate-700">{{ $index + 1 }}</p>
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm font-bold leading-normal text-slate-800">{{ $item->nama_surat }}</h6>
                                        <p class="mb-0 text-xs leading-tight text-slate-500 italic">{{ $item->nomor_surat }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-sm">
                                <span class="px-3 py-1 text-xs font-semibold rounded-2xl bg-slate-100 text-slate-700">
                                    {{ $item->agenda }}
                                </span>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->tanggal_dibuat }}</span>
                                <br>
                                <span class="text-[10px] text-slate-400 uppercase">Oleh: {{ $item->pembuat }}</span>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('arsip.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 transition-all text-xl" title="Edit">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    
                                    <form action="{{ route('arsip.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-500 hover:text-red-700 transition-all text-xl" title="Hapus">
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
            <span class="text-sm font-normal text-slate-500">
                Menampilkan <span class="font-semibold text-slate-800">1</span> sampai <span class="font-semibold text-slate-800">10</span> dari <span class="font-semibold text-slate-800">100</span> data
            </span>
            <div class="inline-flex gap-2">
                <button class="px-4 py-2 text-xs font-semibold border rounded-lg border-slate-200 text-slate-600 hover:bg-slate-50 transition-all disabled:opacity-50">
                    Previous
                </button>
                <button class="px-4 py-2 text-xs font-semibold border rounded-lg border-slate-200 text-slate-600 hover:bg-slate-50 transition-all">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
