@extends('layouts.main')

@section('title','Edit Arsip')

@section('content')
<div class="bg-white p-6 my-6 rounded shadow-lg max-w-3xl mx-auto">

<h2 class="font-bold mb-4">Edit Arsip Surat</h2>

<form method="POST" action="{{ route('arsip.update', $arsip->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Surat</label>
        <input type="text" name="nama_surat"
               value="{{ $arsip->nama_surat }}"
               class="w-full border px-2 py-1">
    </div>

    <div class="mb-3">
        <label>Agenda</label>
        <input type="text" name="agenda"
               value="{{ $arsip->agenda }}"
               class="w-full border px-2 py-1">
    </div>
    
    <div class="mb-3">
        <label>Pembuat</label>
        <input type="text" name="agenda"
               value="{{ $arsip->pembuat }}"
               class="w-full border px-2 py-1">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>

</div>
@endsection


