<header 
    x-data="{ scrolled: false }" 
    @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="scrolled ? 'bg-white/80 backdrop-blur-md border-b border-gray-200' : 'bg-white'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 shadow-sm"
>
    <div class="flex items-center justify-between h-16 px-4 md:px-8 max-w-7xl mx-auto">

        {{-- LEFT SIDE --}}
        <div class="flex items-center gap-4">
            <button
                @click="asideOpen = !asideOpen"
                class="flex items-center justify-center w-10 h-10 rounded-xl text-gray-600 hover:bg-red-50 hover:text-red-600 transition-all duration-200 focus:outline-none"
            >
                <i class="bx bx-menu text-2xl"></i>
            </button>

            <div class="flex flex-col">
                <span class="text-gray-900 font-bold text-lg tracking-tight leading-none">
                    Sistem<span class="text-red-600">Surat</span>
                </span>
                <span class="text-[10px] text-gray-400 font-medium tracking-widest uppercase mt-1">
                    Digital Archive v2.0
                </span>
            </div>
        </div>

        {{-- RIGHT SIDE (Optional Tambahan: User Profile) --}}
        <div class="flex items-center gap-3">
            <div class="hidden sm:flex flex-col text-right mr-2">
                <span class="text-xs font-semibold text-gray-700">{{ auth()->user()->name ?? 'Guest' }}</span>
                <span class="text-[10px] text-green-500 flex items-center justify-end gap-1">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Online
                </span>
            </div>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-red-600 ">
                <i class='bx bxs-user-circle text-3xl'></i>
            </div>
        </div>
    </div>
</header>