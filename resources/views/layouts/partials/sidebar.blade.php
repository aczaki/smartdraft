{{-- OVERLAY (MOBILE) --}}
<div
    x-show="asideOpen"
    x-transition.opacity
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 md:hidden"
    @click="asideOpen = false"
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
>
    <div class="px-3 mb-4">
        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Menu Utama</p>
    </div>

    <nav class="flex flex-col gap-2 flex-grow">
        @php
            $links = [
                ['route' => 'dashboard', 'url' => '/dashboard', 'icon' => 'bx-home-alt-2', 'label' => 'Dashboard'],
                ['route' => 'surat', 'url' => '/surat', 'icon' => 'bx-envelope', 'label' => 'Buat Surat'],
                ['route' => 'list-template', 'url' => route('templates.index'), 'icon' => 'bx-layer', 'label' => 'Template'],
                ['route' => 'list-arsip', 'url' => '/list-arsip', 'icon' => 'bx-archive', 'label' => 'Arsip Surat'],
                ['route' => 'list-user', 'url' => '/list-user', 'icon' => 'bx-user-circle', 'label' => 'Pengguna'],
            ];
        @endphp

        @foreach($links as $link)
            @php
                $isActive = request()->is(trim($link['route'], '/')) || request()->url() == $link['url'];
            @endphp
            
            <a href="{{ $link['url'] }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group
               {{ $isActive 
                  ? 'bg-red-600 text-white shadow-lg shadow-red-900/20 font-semibold' 
                  : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <i class="bx {{ $link['icon'] }} text-xl {{ $isActive ? 'text-white' : 'group-hover:text-red-500' }}"></i>
                <span class="text-sm tracking-wide">{{ $link['label'] }}</span>
                @if($isActive)
                    <div class="ml-auto w-1.5 h-1.5 bg-white rounded-full"></div>
                @endif
            </a>
        @endforeach
    </nav>

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