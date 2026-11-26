@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@php
    $total = $laki + $perempuan;
    $pct = fn($n) => $total ? (int) round($n / $total * 100) : 0;
    $hour = now()->hour;
    $greet = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam'));

    // key => [label tab, subjudul, [label => jumlah]]
    $datasets = [
        'jenis_kelamin' => ['Jenis Kelamin', 'Jenis kelamin', ['Laki-laki' => $laki, 'Perempuan' => $perempuan]],
        'pendidikan' => ['Pendidikan', 'Pendidikan terakhir', ['SD / Sederajat' => $sd, 'SMP / Sederajat' => $smp, 'SMA / Sederajat' => $sma, 'D3 (Diploma)' => $d3, 'S1 (Sarjana)' => $s1, 'S2 (Magister)' => $s2, 'S3 (Doktor)' => $s3]],
        'pekerjaan' => ['Pekerjaan', 'Pekerjaan', ['Pelajar' => $pelajar, 'Mahasiswa' => $mahasiswa, 'PNS' => $pns, 'Wirausaha' => $wirausaha, 'Wiraswasta' => $wiraswasta, 'Lainnya' => $lainnya]],
        'keterangan_tinggal' => ['Tempat Tinggal', 'Keterangan tinggal', ['Bersama Orang Tua' => $orangTua, 'Rumah Keluarga' => $keluarga, 'Kos-kosan' => $kos, 'Asrama' => $asrama]],
        'keanggotaan' => ['Keanggotaan', 'Status keanggotaan gereja', ['SIDI' => $sidi, 'Baptis' => $baptis, 'Baptis Dewasa' => $baptisDewasa, 'Belum' => $belum]],
        'kaderisasi' => ['Kaderisasi', 'Pelatihan kaderisasi', ['Belum Pernah' => $belumPernah, 'LKPD' => $lkpd, 'LKPL' => $lkpl, 'LKPA' => $lkpa, 'TOT' => $tot]],
        'domisili' => ['Domisili', 'Domisili pelayanan', ['Dalam Wilayah' => $dalamWilayah, 'Luar Wilayah' => $luarWilayah]],
        'wilayah' => ['Wilayah', 'Wilayah kelompok', ['Kelompok 1' => $kelompok1, 'Kelompok 2' => $kelompok2]],
        'golongan_darah' => ['Gol. Darah', 'Golongan darah', ['A' => $a, 'B' => $b, 'AB' => $ab, 'O' => $o, 'Tidak Tahu' => $tidakTahu]],
        'status' => ['Status', 'Status pernikahan', ['Belum Menikah' => $belumMenikah, 'Sudah Menikah' => $menikah]],
    ];
    $barKeys = ['jenis_kelamin', 'pendidikan', 'pekerjaan', 'keterangan_tinggal', 'keanggotaan', 'kaderisasi'];
    $ringKeys = ['domisili', 'wilayah', 'golongan_darah', 'status'];
    $kpis = [
        ['Laki-laki', $laki, 'bg-admin-light text-admin'],
        ['Perempuan', $perempuan, 'bg-admin-body text-bronze-500'],
        ['Dalam Wilayah', $dalamWilayah, 'bg-admin-light text-admin'],
        ['Sudah Menikah', $menikah, 'bg-admin-body text-admin-text'],
    ];
    $shortcuts = [
        ['data-anggota.index', 'group', 'Data Keanggotaan'],
        ['kegiatan-mingguan.index', 'event', 'Jadwal Kegiatan'],
        ['artikel.create', 'article', 'Terbitkan Artikel'],
        ['inventaris.index', 'inventory_2', 'Inventaris Asset'],
    ];
    $tabIdle = 'shrink-0 rounded-md px-2.5 py-1 text-xs font-medium text-admin-text hover:text-admin-heading';
    $tabActive = 'shrink-0 rounded-md bg-white px-2.5 py-1 text-xs font-semibold text-admin-heading shadow-sm';
@endphp

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul --}}
        <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-xl font-bold tracking-tight">PPGT Jemaat Satria Kasih</h1>
                <p class="text-sm text-admin-text">{{ $greet }}, {{ Auth::user()->name ?? 'Admin' }} · Ringkasan {{ $total }} anggota terdaftar hari ini.</p>
            </div>
            <a href="{{ route('data-anggota.create') }}"
                class="inline-flex items-center gap-1.5 self-start rounded-lg bg-admin px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-admin-dark sm:self-auto">
                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">person_add</span>
                <span>Tambah Anggota</span>
            </a>
        </div>

        {{-- Metrik --}}
        <section class="grid grid-cols-2 gap-4 lg:grid-cols-4" aria-label="Statistik ringkas anggota">
            @foreach ($kpis as [$label, $value, $pill])
                <div class="flex flex-col gap-3 rounded-xl border border-admin-border bg-white p-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-admin-text">{{ $label }}</span>
                        <span class="rounded-full px-2 py-0.5 font-mono text-[11px] font-medium tabular-nums {{ $pill }}">{{ $pct($value) }}%</span>
                    </div>
                    <div class="text-3xl font-bold tabular-nums">{{ $value }}</div>
                </div>
            @endforeach
        </section>

        {{-- Bento --}}
        <section class="grid grid-cols-1 items-stretch gap-4 lg:grid-cols-12">
            {{-- Grafik anggota --}}
            <article class="flex flex-col justify-between gap-5 rounded-xl border border-admin-border bg-white p-5 lg:col-span-5">
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-bold">Grafik Anggota</h2>
                        <span class="font-mono text-xs text-admin-text tabular-nums">Total: {{ $total }}</span>
                    </div>
                    <div class="flex max-w-full gap-0.5 self-start overflow-x-auto rounded-lg border border-admin-border bg-admin-body p-1 [scrollbar-width:none]" role="tablist">
                        @foreach ($barKeys as $key)
                            <button type="button" role="tab" data-bar-tab="{{ $key }}" class="{{ $loop->first ? $tabActive : $tabIdle }}">{{ $datasets[$key][0] }}</button>
                        @endforeach
                    </div>
                </div>
                <div id="bento-bars" class="flex flex-col gap-4 py-2"></div>
                <div class="flex items-center justify-between border-t border-admin-border pt-3 text-xs text-admin-text">
                    <span>Basis data PPGT Satria Kasih</span>
                    <a href="{{ route('data-anggota.index') }}" class="font-semibold text-admin hover:underline">Detail →</a>
                </div>
            </article>

            {{-- Komposisi --}}
            <article class="flex flex-col justify-between gap-4 rounded-xl border border-admin-border bg-white p-5 lg:col-span-4">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h2 class="text-base font-bold">Komposisi</h2>
                        <p class="text-xs text-admin-text" id="ring-subtitle"></p>
                    </div>
                    <span class="rounded bg-admin-light px-2 py-0.5 text-[11px] font-semibold text-admin">Aktif</span>
                </div>
                <div class="flex flex-wrap gap-1" role="tablist">
                    @foreach ($ringKeys as $key)
                        <button type="button" role="tab" data-ring-tab="{{ $key }}"
                            class="rounded-full border px-2.5 py-0.5 text-[11px] font-semibold {{ $loop->first ? 'border-admin bg-admin text-white' : 'border-admin-border text-admin-text hover:text-admin-heading' }}">{{ $datasets[$key][0] }}</button>
                    @endforeach
                </div>
                <div class="flex flex-col items-center gap-4">
                    <div class="relative flex size-36 items-center justify-center">
                        <svg viewBox="0 0 120 120" class="size-full -rotate-90" role="img" aria-label="Diagram komposisi anggota">
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#e2e8f0" stroke-width="12"></circle>
                            <g id="ring-segments"></g>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-2xl font-bold tabular-nums" id="ring-total">{{ $total }}</span>
                            <span class="text-[11px] text-admin-text">Anggota</span>
                        </div>
                    </div>
                    <ul id="ring-legend" class="flex w-full flex-col gap-2 text-xs"></ul>
                </div>
            </article>

            {{-- Akses cepat --}}
            <article class="flex flex-col justify-between gap-4 rounded-xl bg-admin-ink p-5 text-white lg:col-span-3">
                <div>
                    <span class="font-mono text-[10px] uppercase tracking-wider text-ink-200">Akses Cepat</span>
                    <h2 class="mt-1 text-base font-bold">Menu Pengurus</h2>
                </div>
                <div class="flex flex-col gap-2">
                    @foreach ($shortcuts as [$route, $icon, $label])
                        <a href="{{ route($route) }}"
                            class="flex items-center justify-between rounded-lg bg-white/10 px-3 py-2.5 text-xs font-medium transition-colors hover:bg-white/15">
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">{{ $icon }}</span>
                                <span>{{ $label }}</span>
                            </span>
                            <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">arrow_forward</span>
                        </a>
                    @endforeach
                </div>
                <div class="border-t border-white/10 pt-2 text-[11px] text-ink-200">PPGT Jemaat Satria Kasih</div>
            </article>
        </section>
    </div>
@endsection

@push('addon-script')
    <script>
        (function() {
            const datasets = @json(collect($datasets)->map(fn($d) => ['subtitle' => $d[1], 'items' => $d[2]]));
            const colors = ['#1e40af', '#b45309', '#3b6fd8', '#f6c453', '#93c5fd', '#475569', '#fde68a'];
            const tabActive = @json($tabActive), tabIdle = @json($tabIdle);
            const el = (tag, cls, text) => Object.assign(document.createElement(tag), { className: cls || '', textContent: text ?? '' });
            const rows = (key) => {
                const items = Object.entries(datasets[key].items);
                const sum = items.reduce((s, [, n]) => s + n, 0);
                return { sum, items: items.map(([label, count], i) => ({ label, count, pct: sum ? Math.round(count / sum * 100) : 0, color: colors[i % colors.length] })) };
            };

            function renderBars(key) {
                document.getElementById('bento-bars').replaceChildren(...rows(key).items.map((item) => {
                    const row = el('div', 'flex flex-col gap-1.5');
                    const head = el('div', 'flex items-center justify-between text-xs');
                    head.append(el('span', 'font-semibold text-admin-heading', item.label), el('span', 'font-mono text-admin-text tabular-nums', item.count + ' (' + item.pct + '%)'));
                    const track = el('div', 'h-3 w-full overflow-hidden rounded-full bg-admin-body');
                    const fill = el('div', 'h-full rounded-full transition-all duration-200');
                    Object.assign(fill.style, { width: item.pct + '%', background: item.color });
                    track.append(fill);
                    row.append(head, track);
                    return row;
                }));
            }

            function renderRing(key) {
                const { sum, items } = rows(key);
                document.getElementById('ring-subtitle').textContent = datasets[key].subtitle;
                document.getElementById('ring-total').textContent = sum;
                const c = 2 * Math.PI * 46, ns = 'http://www.w3.org/2000/svg';
                let offset = 0;
                document.getElementById('ring-segments').replaceChildren(...items.filter((i) => i.count).map((item) => {
                    const len = item.count / sum * c;
                    const seg = document.createElementNS(ns, 'circle');
                    Object.entries({ cx: 60, cy: 60, r: 46, fill: 'none', stroke: item.color, 'stroke-width': 12, 'stroke-dasharray': len.toFixed(2) + ' ' + c.toFixed(2), 'stroke-dashoffset': (-offset).toFixed(2) })
                        .forEach(([k, v]) => seg.setAttribute(k, v));
                    offset += len;
                    return seg;
                }));
                document.getElementById('ring-legend').replaceChildren(...items.map((item) => {
                    const li = el('li', 'flex items-center justify-between');
                    const left = el('span', 'flex items-center gap-2 font-medium ' + (item.count ? 'text-admin-heading' : 'text-admin-text'));
                    const dot = el('span', 'size-2.5 rounded-full');
                    dot.style.background = item.color;
                    left.append(dot, el('span', '', item.label));
                    li.append(left, el('span', 'font-mono tabular-nums ' + (item.count ? 'font-semibold text-admin-heading' : 'text-admin-text'), item.count + ' (' + item.pct + '%)'));
                    return li;
                }));
            }

            document.querySelectorAll('[data-bar-tab]').forEach((btn, _, all) => btn.addEventListener('click', () => {
                all.forEach((b) => b.className = b === btn ? tabActive : tabIdle);
                renderBars(btn.dataset.barTab);
            }));
            document.querySelectorAll('[data-ring-tab]').forEach((btn, _, all) => btn.addEventListener('click', () => {
                all.forEach((b) => b.className = 'rounded-full border px-2.5 py-0.5 text-[11px] font-semibold ' + (b === btn ? 'border-admin bg-admin text-white' : 'border-admin-border text-admin-text hover:text-admin-heading'));
                renderRing(btn.dataset.ringTab);
            }));
            renderBars('jenis_kelamin');
            renderRing('domisili');
        })();
    </script>
@endpush
