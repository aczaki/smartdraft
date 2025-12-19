
{{-- OVERLAY (MOBILE) --}}
<div
    x-show="asideOpen"
    x-transition.opacity
    class="fixed inset-0 bg-black/40 z-40 md:hidden"
    @click="toggleSidebar()"
></div>

<aside
    x-show="asideOpen"
    x-transition:enter="transition transform duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition transform duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed top-16 left-0 z-50 w-64 h-[calc(100vh-4rem)]
           bg-zinc-900 border-r shadow flex flex-col p-3"
>

    <nav class="flex flex-col gap-1 text-sm">

        <a href="/dashboard" 
        class="{{ request()->is('dashboard') ? 'bg-sky-900 text-gray-300' : 'text-gray-300' }} flex items-center text-gray-300 gap-3 px-3 py-2 rounded hover:bg-sky-900">
            <i class="bx bx-home text-xl"></i> Dashboard
        </a>

        <a href="/surat" 
        class="{{ request()->is('surat') ? 'bg-sky-900 text-gray-300' : 'text-gray-300' }} flex items-center text-gray-300 gap-3 px-3 py-2 rounded hover:bg-sky-900">
            <i class="bx bx-envelope text-xl"></i> Buat Surat
        </a>

        <!-- <a href="{{ route('templates.index') }}" 
        class="{{ request()->is('list-template') ? 'bg-sky-900 text-gray-300' : 'text-gray-300' }} flex items-center text-gray-300 gap-3 px-3 py-2 rounded hover:bg-sky-900">
            <i class="bx bx-file text-xl"></i> Template
        </a> -->

        <a href="/list-arsip" 
        class="{{ request()->is('list-arsip') ? 'bg-sky-900 text-gray-300' : 'text-gray-300' }} flex items-center text-gray-300 gap-3 px-3 py-2 rounded hover:bg-sky-900">
            <i class="bx bx-archive text-xl"></i> Arsip Surat
        </a>

        <!-- <a href="#" class="flex items-center text-gray-300 gap-3 px-3 py-2 rounded hover:bg-sky-900">
            <i class="bx bx-group text-xl"></i> Pengguna
        </a> -->

    </nav>

    <div class="mt-auto">
        <a href="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2 rounded bg-red-600  hover:bg-sky-900 text-gray-300">
            <i class="bx bx-log-out text-xl"></i> Logout
        </a>
    </div>

</aside>



<!-- {{-- BACKDROP --}}
<div
    x-show="asideOpen"
    x-transition.opacity
    @click="asideOpen = false"
    class="fixed inset-0 bg-black/30 backdrop-blur-sm z-30">
</div> -->


<style>
.sidebar-link {
    @apply flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 transition;
}
</style>