@php
    // Grup => [ [label, ikon Material Symbols, route|null, pola URL aktif, submenu[label => route]] ]
    $groups = [
        null => [
            ['Dashboard', 'dashboard', 'dashboard', ['admin/dashboard*']],
            ['Beranda', 'home', null, ['admin/renungan-harian*', 'admin/kegiatan-mingguan*', 'admin/faq*', 'admin/sekilas-anggota*', 'admin/link-terkait*', 'admin/pundi-kasih*', 'admin/gambar-situs*'], [
                'Gambar Situs' => 'site-image.index',
                'Renungan' => 'renungan-harian.index',
                'Kegiatan Mingguan' => 'kegiatan-mingguan.index',
                'FAQ' => 'faq.index',
                'Sekilas Anggota' => 'sekilas-anggota.index',
                'Link Terkait' => 'link-terkait.index',
                'Pundi Kasih' => 'pundi-kasih.index',
            ]],
        ],
        'Organisasi' => [
            ['Pengurus', 'account_tree', null, ['admin/foto-ksb*', 'admin/pengurus*', 'admin/jabatan*', 'admin/bidang*', 'admin/program-kerja*', 'admin/notulensi-rapat*'], [
                'Foto KSB' => 'foto-ksb.index',
                'Bidang' => 'bidang.index',
                'Jabatan' => 'jabatan.index',
                'Pengurus' => 'pengurus.index',
                'Program Kerja' => 'program-kerja.index',
                'Notulensi Rapat' => 'notulensi-rapat.index',
            ]],
            ['Keanggotaan', 'group', 'data-anggota.index', ['admin/data-anggota*']],
            ['Profil', 'badge', null, ['admin/profil*', 'admin/document*'], [
                'Profil' => 'profil-ppgt.index',
                'Dokumen' => 'document.index',
            ]],
        ],
        'Konten' => [
            ['Artikel', 'article', 'artikel.index', ['admin/artikel*']],
            ['Kegiatan', 'event', null, ['admin/kegiatan', 'admin/kegiatan/*', 'admin/gallery-kegiatan*'], [
                'Kegiatan' => 'kegiatan.index',
                'Galeri Kegiatan' => 'gallery-kegiatan.index',
            ]],
        ],
        'Aset & Keuangan' => [
            ['Asset', 'inventory_2', null, ['admin/inventaris*', 'admin/jenis-inventaris*', 'admin/keuangan*', 'admin/iuran*'], [
                'Inventaris' => 'inventaris.index',
                'Data Keuangan' => 'keuangan',
                'Iuran Anggota' => 'iuran.index',
            ]],
            ['Unit Usaha', 'storefront', null, [], ['Segera Hadir' => null]],
            ['Saran', 'chat_bubble_outline', 'saran.index', ['admin/saran*']],
        ],
        'Sistem' => [
            ['Periode', 'calendar_month', 'periode.index', ['admin/periode*']],
            ['Akun', 'manage_accounts', 'akun.index', ['admin/akun*']],
            ['Log', 'history', 'log.index', ['admin/log*']],
        ],
    ];
    $base = 'flex w-full items-center gap-2.5 rounded-lg px-3 py-2 text-sm transition-colors';
    $idle = 'font-medium text-admin-text hover:bg-admin-body hover:text-admin-heading';
    $current = 'bg-admin-light font-semibold text-admin';
    $user = Auth::user();
    $memberCount = \App\Models\DataAnggota::count();
@endphp

<aside
    class="fixed inset-y-0 left-0 z-50 flex w-64 shrink-0 -translate-x-full flex-col justify-between border-r border-admin-border bg-white transition-transform duration-200 group-data-sidebar-open/admin:translate-x-0 lg:sticky lg:top-0 lg:h-screen lg:translate-x-0">
    <div class="flex min-h-0 flex-col">
        {{-- Brand --}}
        <div class="flex items-center justify-between border-b border-admin-border px-5 py-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                <img src="{{ \App\Models\SiteImage::url('logo') }}" alt="Logo PPGT" class="size-8 shrink-0 object-contain">
                <span>
                    <span class="block text-sm font-bold leading-tight text-admin-heading">SATKAS</span>
                    <span class="block text-[11px] font-medium text-admin-text">Admin Panel</span>
                </span>
            </a>
            <button type="button" data-sidebar-toggle aria-label="Tutup menu"
                class="inline-flex size-8 items-center justify-center rounded-lg text-admin-text hover:bg-admin-body lg:hidden">
                <span class="material-symbols-outlined text-[20px]!">close</span>
            </button>
        </div>

        {{-- Navigasi --}}
        <nav class="flex flex-col gap-5 overflow-y-auto p-3 [scrollbar-width:thin]" aria-label="Menu utama">
            @foreach ($groups as $title => $items)
                <div class="flex flex-col gap-0.5">
                    @if ($title)
                        <span class="px-3 pb-1 text-[11px] font-semibold uppercase tracking-wider text-admin-text">{{ $title }}</span>
                    @endif
                    @foreach ($items as $entry)
                        @php
                            [$label, $icon, $route, $patterns] = $entry;
                            $children = $entry[4] ?? null;
                            $active = $patterns && request()->is(...$patterns);
                        @endphp
                        @if ($children)
                            <details class="group/sub" @if ($active) open @endif>
                                <summary class="{{ $base }} {{ $active ? 'font-semibold text-admin-heading' : $idle }} cursor-pointer list-none justify-between [&::-webkit-details-marker]:hidden">
                                    <span class="flex items-center gap-2.5">
                                        <span class="material-symbols-outlined text-[18px]! {{ $active ? 'text-admin' : '' }}" aria-hidden="true">{{ $icon }}</span>
                                        <span>{{ $label }}</span>
                                    </span>
                                    <span class="material-symbols-outlined text-[16px]! transition-transform group-open/sub:rotate-90" aria-hidden="true">chevron_right</span>
                                </summary>
                                <ul class="ml-[21px] mt-0.5 flex flex-col gap-0.5 border-l border-admin-border pl-2.5">
                                    @foreach ($children as $childLabel => $childRoute)
                                        @php
                                            $url = $childRoute ? route($childRoute) : '#';
                                            $childActive = $childRoute && str_starts_with(url()->current(), $url);
                                        @endphp
                                        <li>
                                            <a href="{{ $url }}" @if ($childActive) aria-current="page" @endif
                                                class="block rounded-lg px-3 py-1.5 text-sm transition-colors {{ $childActive ? $current : $idle }}">
                                                {{ $childLabel }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </details>
                        @else
                            <a href="{{ route($route) }}" @if ($active) aria-current="page" @endif
                                class="{{ $base }} justify-between {{ $active ? $current : $idle }}">
                                <span class="flex items-center gap-2.5">
                                    <span class="material-symbols-outlined text-[18px]! {{ $active ? '[font-variation-settings:"FILL"_1]' : '' }}" aria-hidden="true">{{ $icon }}</span>
                                    <span>{{ $label }}</span>
                                </span>
                                @if ($route === 'data-anggota.index')
                                    <span class="rounded bg-admin-body px-1.5 py-0.5 font-mono text-[11px] text-admin-text">{{ $memberCount }}</span>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </nav>
    </div>

    {{-- Akun --}}
    <div class="border-t border-admin-border p-3">
        <div class="flex items-center justify-between gap-2 rounded-lg bg-admin-body px-2 py-1.5">
            <div class="flex min-w-0 items-center gap-2.5">
                <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-admin-ink text-xs font-semibold text-white">
                    {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                </span>
                <span class="min-w-0">
                    <span class="block truncate text-xs font-semibold text-admin-heading">{{ $user->name ?? 'Admin' }}</span>
                    <span class="block truncate text-[11px] text-admin-text">{{ $user->email ?? '' }}</span>
                </span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" aria-label="Keluar" class="p-1 text-admin-text hover:text-admin-heading">
                    <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Overlay saat sidebar terbuka di layar kecil --}}
<div data-sidebar-toggle
    class="fixed inset-0 z-40 hidden bg-black/30 group-data-sidebar-open/admin:block lg:group-data-sidebar-open/admin:hidden">
</div>
