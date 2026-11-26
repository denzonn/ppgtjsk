{{-- Topbar admin: breadcrumb, cari anggota (⌘K / Ctrl+K), tanggal, tautan ke situs --}}
<header class="sticky top-0 z-20 flex items-center justify-between gap-4 border-b border-admin-border bg-white px-6 py-3">
    <div class="flex min-w-0 items-center gap-2 text-sm">
        <button type="button" data-sidebar-toggle aria-label="Buka menu navigasi"
            class="mr-1 inline-flex size-8 items-center justify-center rounded-lg border border-admin-border text-admin-heading lg:hidden">
            <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">menu</span>
        </button>
        <a href="{{ route('dashboard') }}" class="text-admin-text hover:text-admin-heading">SATKAS</a>
        <span class="text-admin-text">/</span>
        <span class="truncate font-semibold text-admin-heading">@yield('title')</span>
    </div>

    <div class="flex items-center gap-3">
        @php $periodeAktif = \App\Models\Periode::aktif(); @endphp
        @if ($periodeAktif)
            <span class="rounded-lg border border-admin-border bg-white px-3 py-1.5 text-xs font-medium text-admin-heading">Periode {{ $periodeAktif->label() }}</span>
            @if (auth()->user()->isAdminUtama())
                <form action="{{ route('periode.pilih') }}" method="POST">
                    @csrf
                    <select name="periode_id" onchange="this.form.submit()" aria-label="Pilih periode"
                        class="rounded-lg border border-admin-border bg-white px-2 py-1.5 text-xs text-admin-heading">
                        @foreach (\App\Models\Periode::orderByDesc('tahun_mulai')->get() as $p)
                            <option value="{{ $p->id }}" @selected($p->id === $periodeAktif->id)>{{ $p->label() }}</option>
                        @endforeach
                    </select>
                </form>
            @endif
        @endif
        <form action="{{ route('data-anggota.index') }}" method="GET" role="search"
            class="hidden w-64 items-center justify-between gap-2 rounded-lg border border-admin-border bg-admin-body px-3 py-1.5 text-xs text-admin-text focus-within:border-admin md:flex">
            <span class="flex min-w-0 flex-1 items-center gap-1.5">
                <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">search</span>
                <input type="search" name="q" data-command-search placeholder="Cari data anggota..." value="{{ request('q') }}"
                    class="w-full min-w-0 bg-transparent text-admin-heading outline-none placeholder:text-admin-text">
            </span>
            <kbd class="rounded border border-admin-border bg-white px-1.5 py-0.5 font-mono text-[10px] text-admin-text">⌘K</kbd>
        </form>
        <div class="hidden items-center gap-1.5 rounded-lg border border-admin-border bg-white px-3 py-1.5 text-xs font-medium text-admin-text tabular-nums sm:inline-flex">
            <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">calendar_today</span>
            <span>{{ now()->locale('id')->isoFormat('dddd, D MMM YYYY') }}</span>
        </div>
        <a href="{{ route('home') }}" target="_blank" aria-label="Lihat situs publik"
            class="flex size-8 items-center justify-center rounded-lg border border-admin-border bg-white text-admin-text hover:text-admin-heading">
            <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">language</span>
        </a>
    </div>
</header>
