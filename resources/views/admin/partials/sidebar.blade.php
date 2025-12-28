@php
    $links = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin.dashboard')],
        ['label' => 'Data Warga', 'route' => 'admin.warga.index', 'active' => request()->routeIs('admin.warga.*')],
        ['label' => 'Kriteria', 'route' => 'admin.kriteria.index', 'active' => request()->routeIs('admin.kriteria.*') || request()->routeIs('admin.sub-kriteria.*') || request()->routeIs('admin.kriteria.sub-kriteria.*')],
        ['label' => 'Penilaian Warga', 'route' => 'admin.penilaian.index', 'active' => request()->routeIs('admin.penilaian.*')],
        ['label' => 'Perhitungan SAW', 'route' => 'admin.saw.index', 'active' => request()->routeIs('admin.saw.*')],
        ['label' => 'Hasil Rekomendasi', 'route' => 'admin.hasil.index', 'active' => request()->routeIs('admin.hasil.*')],
        ['label' => 'Laporan', 'route' => 'admin.laporan.index', 'active' => request()->routeIs('admin.laporan.*')],
        ['label' => 'Pengaturan', 'route' => 'admin.pengaturan.edit', 'active' => request()->routeIs('admin.pengaturan.*')],
    ];
@endphp

<div id="app-sidebar-overlay" class="fixed inset-0 z-40 hidden bg-slate-900/50 md:hidden" data-sidebar-close></div>

<aside id="app-sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full border-r border-slate-200 bg-white transition-transform md:translate-x-0">
    <div class="flex h-16 items-center justify-between px-4">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white">
                <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }} Logo" class="h-8 w-8 object-contain" />
            </div>
            <div class="leading-tight">
                <div class="text-sm font-semibold text-slate-900">{{ config('app.name') }}</div>
                <div class="text-xs text-slate-500">Admin</div>
            </div>
        </a>

        <button type="button" data-sidebar-close
            class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                <path fill-rule="evenodd"
                    d="M6.72 6.72a.75.75 0 011.06 0L12 10.94l4.22-4.22a.75.75 0 111.06 1.06L13.06 12l4.22 4.22a.75.75 0 11-1.06 1.06L12 13.06l-4.22 4.22a.75.75 0 11-1.06-1.06L10.94 12 6.72 7.78a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="h-[calc(100vh-4rem)] overflow-y-auto px-3 py-4">
        <nav class="space-y-1">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}"
                    class="{{ $link['active'] ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }} flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium">
                    <span class="h-2 w-2 rounded-full {{ $link['active'] ? 'bg-white' : 'bg-slate-300' }}"></span>
                    <span>{{ $link['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>
</aside>
