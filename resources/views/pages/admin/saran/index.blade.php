@extends('layouts.admin')

@section('title')
    Saran
@endsection

@section('content')
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
        {{-- Header: bilah inbox --}}
        <header class="flex flex-wrap items-center gap-4 bg-linear-to-r from-cyan-500 to-blue-500 px-6 py-5 text-white">
            <span class="grid size-12 place-items-center rounded-2xl bg-white/20 text-2xl"><i class="bx bx-envelope-open"></i></span>
            <div class="flex-1">
                <h1 class="text-xl font-extrabold">Kotak Saran</h1>
                <p class="text-sm text-cyan-50">Masukan dari pengunjung lewat formulir "Saran" di beranda.</p>
            </div>
            <span class="rounded-full bg-white/20 px-4 py-1.5 text-sm font-bold">{{ $saran->count() }} pesan</span>
        </header>
        <label class="flex items-center gap-3 border-b border-admin-border px-6 py-3">
            <i class="bx bx-search text-xl text-slate-400"></i>
            <input type="search" data-filter="#inbox" placeholder="Cari nama atau isi saran…" class="w-full bg-transparent py-1 outline-none">
        </label>

        {{-- Percakapan --}}
        <div id="inbox" class="space-y-6 bg-slate-50/60 p-6 md:p-8">
            @forelse ($saran->sortByDesc('created_at') as $item)
                <div data-item class="flex max-w-3xl items-end gap-3 {{ $loop->even ? 'ml-auto flex-row-reverse' : '' }}">
                    <span class="grid size-10 shrink-0 place-items-center rounded-full font-bold text-white {{ ['bg-cyan-500', 'bg-violet-500', 'bg-amber-500', 'bg-rose-500'][$loop->index % 4] }}">
                        {{ strtoupper(mb_substr($item->nama ?: '?', 0, 1)) }}
                    </span>
                    <div class="{{ $loop->even ? 'rounded-br-md bg-cyan-500 text-white' : 'rounded-bl-md bg-white text-slate-700 ring-1 ring-admin-border' }} rounded-3xl px-5 py-3 shadow-sm">
                        <p class="text-xs font-bold {{ $loop->even ? 'text-cyan-50' : 'text-cyan-600' }}">{{ $item->nama ?: 'Anonim' }}</p>
                        <p class="mt-1 whitespace-pre-line">{{ $item->saran }}</p>
                        <p class="mt-2 text-right text-[0.7rem] {{ $loop->even ? 'text-cyan-100' : 'text-slate-400' }}">
                            {{ $item->created_at?->locale('id')->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <p class="py-10 text-center text-slate-400">Belum ada saran masuk.</p>
            @endforelse
        </div>
    </div>
@endsection
