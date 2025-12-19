<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-red-200 via-orange-50 to-amber-100">

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
    @include('layouts.partials.sidebaruser')

    {{-- CONTENT --}}
    <main
        class="pt-16 px-6 transition-all duration-300"
        :class="asideOpen ? 'lg:ml-64' : 'lg:ml-0'"
    >
        @yield('content')
    </main>

</div>

</body>
</html>
