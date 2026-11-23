@php
    // [label, ikon, warna ikon, route|null, pola URL aktif, submenu[label => route]]
    $menu = [
        ['Dashboard', 'bx bx-grid-alt', 'bg-indigo-500/15 text-indigo-300', 'dashboard', ['admin/dashboard*']],
        ['Beranda', 'bx bx-home-heart', 'bg-rose-500/15 text-rose-300', null, ['admin/renungan-harian*', 'admin/kegiatan-mingguan*', 'admin/faq*', 'admin/sekilas-anggota*', 'admin/link-terkait*', 'admin/pundi-kasih*', 'admin/gambar-situs*'], [
            'Gambar Situs' => 'site-image.index',
            'Renungan' => 'renungan-harian.index',
            'Kegiatan Mingguan' => 'kegiatan-mingguan.index',
            'FAQ' => 'faq.index',
            'Sekilas Anggota' => 'sekilas-anggota.index',
            'Link Terkait' => 'link-terkait.index',
            'Pundi Kasih' => 'pundi-kasih.index',
        ]],
        'Organisasi',
        ['Pengurus', 'bx bx-sitemap', 'bg-amber-500/15 text-amber-300', null, ['admin/foto-ksb*', 'admin/pengurus*', 'admin/jabatan*', 'admin/bidang*', 'admin/program-kerja*', 'admin/notulensi-rapat*'], [
            'Foto KSB' => 'foto-ksb.index',
            'Pengurus' => 'pengurus.index',
            'Program Kerja' => 'program-kerja.index',
            'Notulensi Rapat' => 'notulensi-rapat.index',
        ]],
        ['Keanggotaan', 'bx bx-id-card', 'bg-sky-500/15 text-sky-300', 'data-anggota.index', ['admin/data-anggota*']],
        ['Profil', 'bx bx-book-bookmark', 'bg-violet-500/15 text-violet-300', null, ['admin/profil*', 'admin/document*'], [
            'Profil' => 'profil-ppgt.index',
            'Dokumen' => 'document.index',
        ]],
        'Konten',
        ['Artikel', 'bx bx-news', 'bg-fuchsia-500/15 text-fuchsia-300', 'artikel.index', ['admin/artikel*']],
        ['Kegiatan', 'bx bx-calendar-star', 'bg-teal-500/15 text-teal-300', null, ['admin/kegiatan', 'admin/kegiatan/*', 'admin/gallery-kegiatan*'], [
            'Kegiatan' => 'kegiatan.index',
            'Galeri Kegiatan' => 'gallery-kegiatan.index',
        ]],
        'Aset & Keuangan',
        ['Asset', 'bx bx-wallet', 'bg-emerald-500/15 text-emerald-300', null, ['admin/inventaris*', 'admin/jenis-inventaris*', 'admin/keuangan*', 'admin/iuran*'], [
            'Inventaris' => 'inventaris.index',
            'Data Keuangan' => 'keuangan',
            'Iuran Anggota' => 'iuran.index',
        ]],
        ['Unit Usaha', 'bx bx-store-alt', 'bg-orange-500/15 text-orange-300', null, [], ['Segera Hadir' => null]],
        ['Saran', 'bx bx-message-square-dots', 'bg-cyan-500/15 text-cyan-300', 'saran.index', ['admin/saran*']],
    ];
    $item = 'group/item flex w-full items-center gap-3 rounded-xl px-3 py-2 text-[0.9rem] text-slate-300 transition hover:bg-white/5 hover:text-white';
    $activeItem = 'bg-white/10! text-white! shadow-[inset_3px_0_0_0_#818cf8]';
    $user = Auth::user();
@endphp

<aside
    class="fixed inset-y-0 left-0 z-50 flex w-[280px] -translate-x-full flex-col bg-admin-ink bg-[radial-gradient(120%_60%_at_0%_0%,rgba(99,102,241,0.25),transparent_60%),radial-gradient(80%_50%_at_100%_100%,rgba(236,72,153,0.12),transparent_60%)] text-slate-300 transition-transform duration-300 group-data-sidebar-open/admin:translate-x-0 xl:translate-x-0">
    <div class="flex h-20 shrink-0 items-center gap-3 px-6">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <img src="{{ \App\Models\SiteImage::url('logo') }}" alt=""
                class="size-10 rounded-xl bg-white object-contain p-1 shadow-lg shadow-indigo-500/20">
            <span>
                <span class="block text-lg font-extrabold leading-tight tracking-tight text-white">SATKAS</span>
                <span class="block text-[0.7rem] font-medium uppercase tracking-[0.2em] text-indigo-300/80">Admin Panel</span>
            </span>
        </a>
        <button type="button" data-sidebar-toggle aria-label="Tutup menu"
            class="ml-auto grid size-9 place-items-center rounded-xl bg-white/10 text-white xl:hidden">
            <i class="bx bx-x text-xl"></i>
        </button>
    </div>

    <ul class="flex-1 space-y-0.5 overflow-y-auto px-4 pb-4 [scrollbar-width:thin]">
        @foreach ($menu as $entry)
            @if (is_string($entry))
                <li class="px-3 pb-2 pt-5 text-[0.68rem] font-bold uppercase tracking-[0.18em] text-slate-500">{{ $entry }}</li>
                @continue
            @endif
            @php
                [$label, $icon, $tone, $route, $patterns] = $entry;
                $children = $entry[5] ?? null;
                $active = $patterns && request()->is(...$patterns);
            @endphp
            <li>
                @if ($children)
                    <details class="group/sub" @if ($active) open @endif>
                        <summary class="{{ $item }} cursor-pointer list-none [&::-webkit-details-marker]:hidden {{ $active ? $activeItem : '' }}">
                            <span class="grid size-8 place-items-center rounded-lg {{ $tone }}"><i class="{{ $icon }} text-lg"></i></span>
                            <span class="font-medium">{{ $label }}</span>
                            <i class="bx bx-chevron-down ml-auto text-lg text-slate-500 transition-transform group-open/sub:rotate-180"></i>
                        </summary>
                        <ul class="relative my-1 ml-7 space-y-0.5 border-l border-white/10 pl-4">
                            @foreach ($children as $childLabel => $childRoute)
                                @php
                                    $url = $childRoute ? route($childRoute) : '#';
                                    $childActive = $childRoute && str_starts_with(url()->current(), $url);
                                @endphp
                                <li>
                                    <a href="{{ $url }}"
                                        class="relative block rounded-lg px-3 py-1.5 text-[0.85rem] transition hover:text-white {{ $childActive ? 'bg-indigo-500/15 font-semibold text-white before:absolute before:-left-[17px] before:top-1/2 before:size-2 before:-translate-y-1/2 before:rounded-full before:bg-indigo-400 before:ring-4 before:ring-indigo-400/20' : 'text-slate-400' }}">
                                        {{ $childLabel }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </details>
                @else
                    <a href="{{ route($route) }}" class="{{ $item }} {{ $active ? $activeItem : '' }}">
                        <span class="grid size-8 place-items-center rounded-lg {{ $tone }}"><i class="{{ $icon }} text-lg"></i></span>
                        <span class="font-medium">{{ $label }}</span>
                    </a>
                @endif
            </li>
        @endforeach
    </ul>

    {{-- Kartu user + logout --}}
    <div class="m-4 flex items-center gap-3 rounded-2xl bg-white/5 p-3 ring-1 ring-white/10">
        <span
            class="grid size-10 shrink-0 place-items-center rounded-xl bg-linear-to-br from-indigo-500 to-fuchsia-500 font-bold text-white">
            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
        </span>
        <span class="min-w-0 flex-1">
            <span class="block truncate text-sm font-semibold text-white">{{ $user->name ?? 'Admin' }}</span>
            <span class="block truncate text-xs text-slate-400">{{ $user->email ?? '' }}</span>
        </span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" title="Logout"
                class="grid size-9 place-items-center rounded-xl text-slate-400 transition hover:bg-rose-500/15 hover:text-rose-300">
                <i class="bx bx-log-out text-xl"></i>
            </button>
        </form>
    </div>
</aside>

{{-- Overlay saat sidebar terbuka di layar kecil --}}
<div data-sidebar-toggle
    class="fixed inset-0 z-40 hidden bg-slate-950/60 backdrop-blur-sm group-data-sidebar-open/admin:block xl:group-data-sidebar-open/admin:hidden">
</div>
