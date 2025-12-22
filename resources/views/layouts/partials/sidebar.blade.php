{{-- OVERLAY (MOBILE) --}}
<div
    x-show="asideOpen"
    x-transition.opacity
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 md:hidden"
    @click="asideOpen = false"
    style="display: none;"
></div>

<aside
    x-show="asideOpen"
    x-transition:enter="transition transform duration-300 ease-out"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition transform duration-300 ease-in"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed top-16 left-0 z-50 w-64 h-[calc(100vh-4rem)]
           bg-[#0f172a] border-r border-slate-800 shadow-2xl flex flex-col p-4"
    style="display: none;"
>
    <div class="px-3 mb-4">
        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Menu Utama</p>
    </div>

    {{-- Navigasi Utama dengan State Alpine.js --}}
    <nav class="flex flex-col gap-2 flex-grow" x-data="{ openSub: null }">
        @php
            $links = [
                ['route' => 'dashboard', 'url' => '/dashboard', 'icon' => 'bx-home-alt-2', 'label' => 'Dashboard'],
                [
                    'route' => 'surat', 
                    'url' => '#', 
                    'icon' => 'bx-envelope', 
                    'label' => 'Buat Surat', 
                    'submenu' => [
                        ['url' => '/surat', 'label' => 'Generate'],
                        ['url' => '/based', 'label' => 'Formulir']
                    ],
                ],
                ['route' => 'list-template', 'url' => route('templates.index'), 'icon' => 'bx-layer', 'label' => 'Template'],
                ['route' => 'list-arsip', 'url' => '/list-arsip', 'icon' => 'bx-archive', 'label' => 'Arsip Surat'],
                ['route' => 'list-user', 'url' => '/list-user', 'icon' => 'bx-user-circle', 'label' => 'Pengguna'],
            ];
        @endphp

        @foreach($links as $index => $link)
            @php
                $hasSubmenu = isset($link['submenu']);
                // Cek apakah menu utama aktif (termasuk jika sub-menunya sedang dibuka)
                $isActive = request()->is(trim($link['url'], '/').'*') || ($link['route'] !== '#' && request()->routeIs($link['route'].'*'));
            @endphp

            <div class="flex flex-col">
                {{-- Tombol Menu Utama --}}
                <a 
                    @if($hasSubmenu) 
                        href="javascript:void(0)" 
                        @click="openSub = (openSub === {{ $index }} ? null : {{ $index }})"
                    @else 
                        href="{{ $link['url'] }}" 
                    @endif
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group
                    {{ $isActive 
                        ? 'bg-red-600 text-white shadow-lg shadow-red-900/20 font-semibold' 
                        : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}"
                >
                    <i class="bx {{ $link['icon'] }} text-xl {{ $isActive ? 'text-white' : 'group-hover:text-red-500' }}"></i>
                    <span class="text-sm tracking-wide">{{ $link['label'] }}</span>

                    @if($hasSubmenu)
                        <i class="bx bx-chevron-down ml-auto transition-transform duration-200"
                           :class="openSub === {{ $index }} ? 'rotate-180' : ''"></i>
                    @elseif($isActive)
                        <div class="ml-auto w-1.5 h-1.5 bg-white rounded-full"></div>
                    @endif
                </a>

                {{-- Kontainer Submenu --}}
                @if($hasSubmenu)
                    <div 
                        x-show="openSub === {{ $index }}" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="flex flex-col mt-1 ml-9 border-l border-slate-700 space-y-1"
                        style="display: none;"
                    >
                        @foreach($link['submenu'] as $sub)
                            <a href="{{ $sub['url'] }}" 
                               class="py-2 px-4 text-sm text-slate-400 hover:text-red-500 transition-colors rounded-lg hover:bg-slate-800/50">
                                {{ $sub['label'] }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </nav>

    {{-- Bagian Logout --}}
    <div class="mt-auto pt-4 border-t border-slate-800">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="flex items-center gap-3 px-4 py-3 w-full rounded-xl text-slate-400 hover:bg-red-500/10 hover:text-red-500 transition-all duration-200 group">
                <i class="bx bx-log-out-circle text-xl group-hover:rotate-12 transition-transform"></i>
                <span class="text-sm font-medium">Keluar Aplikasi</span>
            </button>
        </form>
    </div>
</aside>