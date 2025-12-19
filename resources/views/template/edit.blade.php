@extends('layouts.main')

@section('title', 'Edit Template')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Template</h3>

    <form action="{{ route('templates.update', $template->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Keyword</label><br>
            <input type="text" class="border rounded-md px-2 my-2" name="keyword" value="{{ $template->keyword }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Path File</label><br>
            <input type="text" class="border rounded-md px-2 my-2" name="path_file" value="{{ $template->path_file }}" readonly>
        </div>

        <button type="submit" class='border rounded-md px-2'>Simpan Perubahan</button>
        <a href="{{ route('templates.index') }}" class="border rounded-md px-2">Kembali</a>
    </form>
</div>
@endsection