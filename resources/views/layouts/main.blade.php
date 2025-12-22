<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-slate-100">

<div
    x-data="{
        asideOpen: false,
        profileOpen: false
    }"
    class="relative min-h-screen overflow-x-hidden"
    >

    {{-- HEADER --}}
    @include('layouts.partials.header')

    {{-- OVERLAY --}}
    <div
        x-show="asideOpen"
        x-transition.opacity
        @click="asideOpen = false"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40"
    ></div>

    {{-- SIDEBAR --}}
    @include('layouts.partials.sidebar')

    {{-- CONTENT --}}
    <main
    class="pt-16 px-6 transition-all duration-300"
    :class="asideOpen ? 'lg:ml-64' : 'lg:ml-0'"
    >
        @yield('content')
    </main>

</div>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
            });
        @endif
    </script>
<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626', // Red-600
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Mencari form terdekat dari tombol yang diklik lalu submit
                button.closest('form').submit();
            }
        })
    }
</script>
</body>
</html>
