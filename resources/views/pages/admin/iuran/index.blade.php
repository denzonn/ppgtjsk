@extends('layouts.admin')

@section('title')
    Iuran Anggota
@endsection

@php
    $groups = $iuran->groupBy(fn($i) => $i->kelompok ?: 'Lainnya')->sortKeys();
@endphp

@section('content')
    {{-- Header: dua kolom, total iuran sebagai "celengan" --}}
    <header class="mb-8 grid gap-6 md:grid-cols-[1fr_auto]">
        <div>
            <h1 class="text-3xl font-semibold text-admin-heading">Iuran Anggota</h1>
            <p class="text-slate-500">Daftar ini juga tampil di halaman publik "Iuran". Pilih kelompok untuk melihat anggotanya.</p>
            <a href="{{ route('iuran.create') }}"
                class="mt-4 inline-flex items-center gap-2 rounded-lg bg-ink-600 px-5 py-3 font-semibold text-white hover:bg-ink-700">
                <i class="bx bx-user-plus text-xl"></i> Tambah Data Iuran
            </a>
        </div>
        <div class="flex items-center gap-4 rounded-xl bg-ink-100 p-6 text-ink-950">
            <i class="bx bx-coin-stack text-4xl text-ink-600"></i>
            <div>
                <p class="text-sm font-semibold text-ink-800">Total terkumpul</p>
                <p class="text-3xl font-semibold">Rp {{ number_format($iuran->sum(fn($i) => (int) $i->jumlah), 0, ',', '.') }}</p>
                <p class="text-xs text-ink-700">{{ $iuran->count() }} anggota · {{ $groups->count() }} kelompok</p>
            </div>
        </div>
    </header>

    {{-- Tab per kelompok (radio, tanpa JS) --}}
    <div class="rounded-xl bg-white p-2 border border-admin-border">
        <div class="flex flex-wrap gap-1 border-b border-admin-border p-2">
            @foreach ($groups as $kelompok => $rows)
                <label class="cursor-pointer rounded-lg px-4 py-2 text-sm font-semibold text-slate-500 transition hover:bg-ink-50 has-[:checked]:bg-ink-600 has-[:checked]:text-white">
                    <input type="radio" name="kelompok-tab" value="{{ $loop->index }}" class="peer sr-only" @checked($loop->first)
                        onchange="document.querySelectorAll('[data-tab]').forEach(t => t.hidden = t.dataset.tab !== this.value)">
                    {{ $kelompok }} <span class="ml-1 opacity-70">({{ $rows->count() }})</span>
                </label>
            @endforeach
        </div>
        @forelse ($groups as $kelompok => $rows)
            <div data-tab="{{ $loop->index }}" @unless ($loop->first) hidden @endunless class="divide-y divide-admin-border">
                @foreach ($rows as $item)
                    <div class="flex flex-wrap items-center gap-4 px-4 py-3 hover:bg-ink-50/50">
                        <span class="grid size-10 place-items-center rounded-full bg-ink-100 font-bold text-ink-700">{{ strtoupper(mb_substr($item->nama, 0, 1)) }}</span>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-admin-heading">{{ $item->nama }}</p>
                            <p class="truncate text-sm text-slate-500">{{ $item->keterangan }}</p>
                        </div>
                        <p class="font-mono font-bold text-ink-700">Rp {{ number_format((int) $item->jumlah, 0, ',', '.') }}</p>
                        <a href="{{ route('iuran.edit', $item->id) }}" title="Ubah"
                            class="grid size-9 place-items-center rounded-lg text-slate-500 hover:bg-ink-100 hover:text-ink-700"><i class="bx bx-edit-alt text-lg"></i></a>
                    </div>
                @endforeach
            </div>
        @empty
            <p class="p-10 text-center text-slate-400">Belum ada data iuran.</p>
        @endforelse
    </div>
@endsection
