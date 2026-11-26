@extends('layouts.admin')

@section('title')
    Periode {{ $periode->label() }}
@endsection

@section('content')
    @php
        $ikon = [
            'pengurus' => 'groups', 'bidang' => 'account_tree', 'jabatan' => 'military_tech', 'foto-ksb' => 'photo_camera',
            'program-kerja' => 'task_alt', 'notulensi' => 'description', 'artikel' => 'article', 'kegiatan' => 'event',
            'galeri' => 'photo_library',
        ];
        $status = $periode->isAktif() ? 'Aktif' : ($periode->tahun_mulai > now()->year ? 'Akan datang' : 'Selesai');
    @endphp
    <div class="mx-auto flex w-full max-w-6xl flex-col gap-6">
        <header class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('periode.index') }}" title="Kembali ke daftar periode"
                    class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading">
                    <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">arrow_back</span>
                </a>
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Data periode</p>
                    <h1 class="text-xl font-bold tracking-tight tabular-nums">Periode {{ $periode->tahun_mulai }}–{{ $periode->tahun_selesai }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs">
                <span class="rounded-full bg-admin-light px-2.5 py-1 font-semibold text-admin ring-1 ring-admin/20">{{ $status }}</span>
                <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 font-semibold text-slate-600 ring-1 ring-slate-200">
                    <span class="material-symbols-outlined text-[14px]!" aria-hidden="true">visibility</span> Hanya lihat
                </span>
            </div>
        </header>

        <div class="grid gap-6 lg:grid-cols-[220px_1fr]">
            <nav class="flex gap-1 overflow-x-auto rounded-xl border border-admin-border bg-white p-2 lg:flex-col lg:self-start" aria-label="Jenis data">
                @foreach ($semua as $kunci => $t)
                    @php $pilih = $kunci === $aktif; @endphp
                    <a href="{{ route('periode.show', [$periode, 'tab' => $kunci]) }}" @if ($pilih) aria-current="page" @endif
                        class="flex shrink-0 items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm transition-colors {{ $pilih ? 'bg-admin-light font-semibold text-admin' : 'font-medium text-admin-text hover:bg-admin-body hover:text-admin-heading' }}">
                        <span class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px]! {{ $pilih ? "[font-variation-settings:'FILL'_1]" : '' }}" aria-hidden="true">{{ $ikon[$kunci] }}</span>
                            {{ $t[0] }}
                        </span>
                        <span class="rounded px-1.5 py-0.5 font-mono text-[11px] tabular-nums {{ $pilih ? 'bg-white text-admin' : 'bg-admin-body text-admin-text' }}">{{ $jumlah[$kunci] }}</span>
                    </a>
                @endforeach
            </nav>

            <section class="flex min-w-0 flex-col gap-4">
                <div class="flex items-baseline justify-between gap-3">
                    <h2 class="text-base font-bold">{{ $semua[$aktif][0] }}</h2>
                    <span class="text-xs text-admin-text tabular-nums">{{ $jumlah[$aktif] }} data</span>
                </div>

                <div class="overflow-hidden rounded-xl border border-admin-border bg-white">
                    @if ($baris->isEmpty())
                        <div class="flex flex-col items-center gap-2 px-6 py-14 text-center">
                            <span class="grid size-12 place-items-center rounded-full bg-admin-body text-admin-text">
                                <span class="material-symbols-outlined text-[24px]!" aria-hidden="true">{{ $ikon[$aktif] }}</span>
                            </span>
                            <p class="text-sm font-semibold text-admin-heading">Belum ada data {{ strtolower($semua[$aktif][0]) }}</p>
                            <p class="text-xs text-admin-text">Data akan muncul setelah admin periode {{ $periode->label() }} mengisinya.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="border-b border-admin-border bg-admin-body/60 text-xs uppercase tracking-wide text-admin-text">
                                        <th class="w-12 px-4 py-3 font-semibold">#</th>
                                        @foreach (array_keys($kolom) as $judul)
                                            <th class="px-4 py-3 font-semibold">{{ $judul }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-admin-border">
                                    @foreach ($baris as $item)
                                        <tr class="transition-colors hover:bg-admin-body/40">
                                            <td class="px-4 py-3 font-mono text-xs text-admin-text tabular-nums">{{ $baris->firstItem() + $loop->index }}</td>
                                            @foreach ($kolom as $judul => $nilai)
                                                <td class="px-4 py-3 {{ $loop->first ? 'font-semibold text-admin-heading' : 'text-admin-text' }}">
                                                    @if ($judul === 'Foto')
                                                        <img src="{{ $nilai($item) }}" alt="" class="h-12 w-16 rounded-md object-cover ring-1 ring-admin-border" loading="lazy">
                                                    @else
                                                        {{ $nilai($item) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                @if ($baris->hasPages())
                    <div>{{ $baris->links() }}</div>
                @endif
            </section>
        </div>
    </div>
@endsection
