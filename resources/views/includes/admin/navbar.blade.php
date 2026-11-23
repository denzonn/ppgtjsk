{{-- Topbar admin: breadcrumb dari judul halaman, tanggal, dan avatar --}}
<header
    class="sticky top-0 z-30 border-b border-admin-border/70 bg-admin-body/80 backdrop-blur-xl">
    <div class="mx-auto flex h-16 max-w-[1400px] items-center gap-4 px-4 md:px-8">
        <button type="button" data-sidebar-toggle aria-label="Buka menu"
            class="grid size-10 place-items-center rounded-xl bg-white text-admin-heading shadow-sm ring-1 ring-admin-border xl:hidden">
            <i class="bx bx-menu-alt-left text-2xl"></i>
        </button>
        <nav class="flex min-w-0 items-center gap-2 text-sm">
            <a href="{{ route('dashboard') }}" class="text-slate-400 transition hover:text-admin"><i
                    class="bx bx-home-alt text-lg"></i></a>
            <i class="bx bx-chevron-right text-slate-300"></i>
            <span class="truncate font-semibold text-admin-heading">@yield('title')</span>
        </nav>
        <div class="ml-auto flex items-center gap-3">
            <span class="hidden items-center gap-2 rounded-xl bg-white px-3 py-2 text-xs font-medium text-slate-500 shadow-sm ring-1 ring-admin-border md:flex">
                <i class="bx bx-calendar text-base text-admin"></i>
                {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </span>
            <a href="{{ route('home') }}" target="_blank" title="Lihat situs"
                class="grid size-10 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-admin">
                <i class="bx bx-globe text-xl"></i>
            </a>
        </div>
    </div>
</header>
