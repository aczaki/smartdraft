@extends('layouts.main')

@section('title', 'Upload Template')

@section('content')

<div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-soft-xl rounded-2xl border-0">
            
            <div class="p-6 pb-0 bg-white">
                <div class="flex items-center gap-3 mb-1">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-red-50 text-red-600">
                        <i class='bx bx-cloud-upload text-2xl'></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Upload Template Surat</h2>
                        <p class="text-sm text-slate-500">Tambahkan file .docx sebagai master template otomasi.</p>
                    </div>
                </div>
                <div class="mt-4 border-b border-slate-100"></div>
            </div>

            <form method="POST" enctype="multipart/form-data" action="{{ route('uploadTemplate') }}" class="p-6 space-y-6">
                @csrf

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-slate-700 ml-1">Jenis Surat</label>
                    <input 
                        type="text" 
                        name="jenis_surat" 
                        placeholder="Contoh: Surat Undangan Rapat"
                        required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 focus:bg-white outline-none transition-all duration-300"
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-slate-700 ml-1">Keyword Pendeteksi</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="keyword" 
                            placeholder="undangan, rapat, koordinasi"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-red-500/20 focus:border-red-500 focus:bg-white outline-none transition-all duration-300"
                        >
                        <div class="absolute inset-y-0 right-3 flex items-center text-slate-400">
                            <i class='bx bx-purchase-tag-alt text-lg'></i>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mt-2 ml-1">
                        <i class='bx bx-info-circle mr-1'></i> Pisahkan dengan koma (,) untuk multi-keyword
                    </p>
                </div>

                            <div class="space-y-1" x-data="{ fileName: '' }">
                <label class="block text-sm font-bold text-slate-700 ml-1">File Template (.docx)</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full min-h-[11rem] border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer bg-slate-50 hover:bg-red-50/30 hover:border-red-300 transition-all group p-4">
                        
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <div class="w-12 h-12 mb-3 rounded-full shadow-sm flex items-center justify-center transition-colors"
                                :class="fileName ? 'bg-green-50 text-green-500' : 'bg-white text-slate-400 group-hover:text-red-500'">
                                <i class='bx' :class="fileName ? 'bxs-file-check' : 'bxs-file-doc text-3xl'"></i>
                            </div>

                            <template x-if="!fileName">
                                <div class="text-center">
                                    <p class="mb-1 text-sm text-slate-600 font-semibold px-4">
                                        Klik untuk pilih file atau <span class="text-red-600">tarik & lepas</span>
                                    </p>
                                    <p class="text-xs text-slate-400 uppercase tracking-tighter">Hanya format Microsoft Word (.docx)</p>
                                </div>
                            </template>

                            <template x-if="fileName">
                                <div class="text-center animate-fade-in">
                                    <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">File Terpilih:</p>
                                    <p class="text-sm text-green-600 font-bold px-4 break-all" x-text="fileName"></p>
                                    <button type="button" @click.prevent="fileName = ''; $refs.fileInput.value = ''" class="mt-2 text-[10px] text-red-500 hover:underline font-bold uppercase">
                                        Ganti File
                                    </button>
                                </div>
                            </template>
                        </div>

                        <input 
                            x-ref="fileInput"
                            type="file" 
                            name="template_file" 
                            accept=".docx" 
                            required 
                            class="hidden" 
                            @change="fileName = $event.target.files[0].name"
                        />
                    </label>
                </div>
            </div>

                <div class="pt-4 flex items-center justify-between gap-4">
                    <a href="{{ route('templates.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                        class="flex items-center justify-center gap-2 px-8 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-red-700 to-red-500 rounded-xl cursor-pointer shadow-soft-md hover:shadow-soft-2xl active:opacity-85 active:scale-95">
                        <i class='bx bx-upload'></i>
                        <span>Upload Template</span>
                    </button>
                </div>
            </form>

            <div class="bg-slate-50/50 p-4 border-t border-slate-100 flex justify-center gap-4">
                <span class="flex items-center gap-1 text-[10px] text-slate-400 font-bold uppercase">
                    <i class='bx bx-check-double text-green-500'></i> Validated Format
                </span>
                <span class="flex items-center gap-1 text-[10px] text-slate-400 font-bold uppercase">
                    <i class='bx bx-shield-quarter text-blue-500'></i> Secure Storage
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
