@extends('layouts.admin')

@section('title')
    Approval Anggota
@endsection

@section('content')
    {{-- Header: antrean --}}
    <header class="mb-8 flex flex-wrap items-center gap-4">
        <a href="{{ route('data-anggota.index') }}" title="Kembali"
            class="grid size-11 place-items-center rounded-lg bg-white text-slate-500 border border-admin-border hover:text-ink-600"><i class="bx bx-arrow-back text-xl"></i></a>
        <div class="flex-1">
            <h1 class="text-2xl font-semibold text-admin-heading">Menunggu Persetujuan</h1>
            <p class="text-sm text-slate-500">Pendaftar dari formulir keanggotaan publik.</p>
        </div>
        <span class="relative grid size-14 place-items-center rounded-xl bg-ink-600 text-2xl font-semibold text-white">
            {{ $data->count() }}
            @if ($data->count())
                <span class="absolute -right-1 -top-1 size-4 animate-ping rounded-full bg-danger-400"></span>
            @endif
        </span>
    </header>

    <div class="space-y-3">
        @forelse ($data as $item)
            <article class="flex flex-wrap items-center gap-4 rounded-xl border-l-4 border-ink-500 bg-white p-4 border border-admin-border">
                <span class="grid size-12 place-items-center rounded-xl bg-ink-100 text-lg font-semibold text-ink-700">{{ strtoupper(mb_substr($item->nama, 0, 1)) }}</span>
                <div class="min-w-48 flex-1">
                    <h2 class="font-bold text-admin-heading">{{ $item->nama }}</h2>
                    <p class="font-mono text-xs text-slate-400">NIK {{ $item->nik }}</p>
                </div>
                <div class="flex flex-wrap gap-2 text-xs font-semibold">
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-slate-600"><i class="bx bx-phone"></i> {{ $item->no_hp }}</span>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-slate-600">{{ $item->jenis_kelamin }}</span>
                    <span class="rounded-full bg-danger-50 px-3 py-1 text-danger-600">Gol. {{ $item->golongan_darah }}</span>
                </div>
                <a href="{{ route('data-anggota.detail-approval', $item->id) }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-ink-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-ink-700">
                    Tinjau <i class="bx bx-right-arrow-alt"></i>
                </a>
            </article>
        @empty
            <div class="rounded-xl bg-white p-12 text-center border border-admin-border">
                <i class="bx bx-check-double text-4xl text-ink-400"></i>
                <p class="mt-2 font-semibold text-admin-heading">Semua pendaftar sudah ditinjau.</p>
            </div>
        @endforelse
    </div>
@endsection
