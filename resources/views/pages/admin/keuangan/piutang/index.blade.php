@extends('layouts.admin')

@section('title')
    Piutang
@endsection

@php
    [$lunas, $belum] = $piutang->partition(fn($p) => $p->status !== 'Belum Lunas');
@endphp

@section('content')
    {{-- Header: progres pelunasan --}}
    <header class="mb-8 rounded-3xl bg-amber-50 p-6 ring-1 ring-amber-200 md:p-8">
        <div class="flex flex-wrap items-center gap-4">
            <a href="{{ route('keuangan') }}" title="Kembali ke Keuangan"
                class="grid size-11 place-items-center rounded-xl bg-white text-amber-700 shadow-sm"><i class="bx bx-arrow-back text-xl"></i></a>
            <div class="flex-1">
                <h1 class="text-2xl font-extrabold text-amber-950">Piutang</h1>
                <p class="text-sm text-amber-800/70">{{ $belum->count() }} belum lunas ·
                    Rp {{ number_format($belum->sum('jumlah'), 0, ',', '.') }} masih ditagih</p>
            </div>
            <a href="{{ route('piutang.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-amber-500 px-5 py-3 font-semibold text-white shadow-lg shadow-amber-500/30 hover:bg-amber-600">
                <i class="bx bx-plus"></i> Catat Piutang
            </a>
        </div>
        @php($pct = $piutang->count() ? round($lunas->count() / $piutang->count() * 100) : 0)
        <div class="mt-6">
            <div class="mb-1 flex justify-between text-xs font-semibold text-amber-800"><span>Pelunasan</span><span>{{ $pct }}%</span></div>
            <div class="h-3 overflow-hidden rounded-full bg-white ring-1 ring-amber-200">
                <div class="h-full rounded-full bg-linear-to-r from-amber-400 to-green-500" style="width: {{ $pct }}%"></div>
            </div>
        </div>
    </header>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($belum->concat($lunas) as $item)
            @php($paid = $item->status !== 'Belum Lunas')
            <article class="flex overflow-hidden rounded-2xl bg-white shadow-sm ring-1 {{ $paid ? 'ring-green-200 opacity-80' : 'ring-amber-200' }}">
                <img src="{{ $item->photo }}" alt="bukti" class="w-28 shrink-0 object-cover">
                <div class="flex flex-1 flex-col p-4">
                    <span class="w-fit rounded-full px-2.5 py-0.5 text-[0.7rem] font-bold uppercase tracking-wider {{ $paid ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                        <i class="bx {{ $paid ? 'bx-check-circle' : 'bx-time' }}"></i> {{ $item->status }}
                    </span>
                    <h2 class="mt-2 font-bold text-admin-heading">{{ $item->keterangan }}</h2>
                    <p class="text-xl font-black {{ $paid ? 'text-green-600 line-through decoration-2' : 'text-amber-600' }}">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</p>
                    <div class="rich-text mt-1 line-clamp-2 text-xs text-slate-500">{!! $item->catatan !!}</div>
                    @unless ($paid)
                        <a href="{{ route('piutang.edit', $item->id) }}"
                            class="mt-auto self-start pt-3 text-sm font-bold text-amber-700 hover:underline"><i class="bx bx-edit-alt"></i> Perbarui status</a>
                    @endunless
                </div>
            </article>
        @empty
            <p class="col-span-full rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada piutang.</p>
        @endforelse
    </div>
@endsection
