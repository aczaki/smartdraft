@extends('layouts.main')

@section('title','Edit Pengguna')

@section('content')
<div class="bg-white p-6 my-6 rounded shadow-lg max-w-3xl mx-auto">

<h2 class="font-bold mb-4">Edit Pengguna</h2>

<form method="POST" action="">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name"
               value="{{ $user->name }}"
               class="w-full border px-2 py-1">
    </div>

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username"
               value="{{ $user->username }}"
               class="w-full border px-2 py-1">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>

</div>
@endsection


@emdsection