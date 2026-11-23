@extends('layouts.admin')

@section('title')
    Pundi Kasih
@endsection

@section('content')
    {{-- Header: dompet --}}
    <header class="mb-10 flex flex-wrap items-center justify-between gap-6 rounded-3xl bg-linear-to-br from-emerald-50 to-teal-50 p-6 ring-1 ring-emerald-100 md:p-8">
        <div class="flex items-center gap-5">
            <span class="grid size-16 place-items-center rounded-2xl bg-emerald-600 text-3xl text-white shadow-lg shadow-emerald-600/30"><i class="bx bx-donate-heart"></i></span>
            <div>
                <h1 class="text-3xl font-extrabold text-emerald-950">Pundi Kasih</h1>
                <p class="text-emerald-800/70">Rekening yang ditampilkan di beranda. Rekening berisi "-" atau kosong tidak ditampilkan.</p>
            </div>
        </div>
        <a href="{{ route('site-image.index') }}" class="text-sm font-semibold text-emerald-700 underline underline-offset-4">Ganti logo bank →</a>
    </header>

    <div class="grid gap-8 md:grid-cols-2 2xl:grid-cols-3">
        @foreach ($pundiKasih as $item)
            @php
                $active = $item->no_rek && $item->no_rek !== '-';
                $card = [
                    'mandiri' => 'from-[#003d79] to-[#0a5fb4]',
                    'bni' => 'from-[#005e6a] to-[#f15a23]',
                    'bri' => 'from-[#00529c] to-[#0a74d1]',
                    'bca' => 'from-[#0060af] to-[#1c8ad8]',
                ][strtolower($item->bank->name)] ?? 'from-slate-700 to-slate-900';
            @endphp
            <article class="group">
                {{-- Kartu ATM --}}
                <div
                    class="relative aspect-[1.586] overflow-hidden rounded-3xl bg-linear-to-br p-6 text-white shadow-2xl shadow-slate-400/40 transition group-hover:-translate-y-1 group-hover:rotate-1 {{ $card }} {{ $active ? '' : 'grayscale' }}">
                    <span class="absolute -right-16 -top-16 size-56 rounded-full bg-white/10"></span>
                    <span class="absolute -bottom-20 right-10 size-56 rounded-full bg-white/5"></span>
                    <div class="relative flex h-full flex-col">
                        <div class="flex items-start justify-between">
                            <img src="{{ \App\Models\SiteImage::bankLogo($item->bank->name) }}" alt="{{ $item->bank->name }}"
                                class="h-8 rounded-md bg-white px-2 py-1 object-contain">
                            <i class="bx bx-wifi rotate-90 text-2xl text-white/70"></i>
                        </div>
                        <span class="mt-5 h-9 w-12 rounded-md bg-linear-to-br from-yellow-200 to-amber-400 shadow-inner"></span>
                        <p class="mt-auto font-mono text-xl tracking-[0.15em] md:text-2xl">{{ !$active ? '•••• •••• ••••' : (ctype_digit($item->no_rek) ? trim(chunk_split($item->no_rek, 4, ' ')) : $item->no_rek) }}</p>
                        <div class="mt-2 flex items-end justify-between">
                            <div>
                                <p class="text-[0.6rem] uppercase tracking-widest text-white/60">Atas nama</p>
                                <p class="font-semibold uppercase">{{ $item->atas_nama ?: '—' }}</p>
                            </div>
                            <p class="text-lg font-black italic">{{ strtoupper($item->bank->name) }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between px-2">
                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold {{ $active ? 'text-emerald-600' : 'text-slate-400' }}">
                        <span class="size-2 rounded-full {{ $active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                        {{ $active ? 'Tampil di beranda' : 'Disembunyikan' }}
                    </span>
                    <a href="{{ route('pundi-kasih.edit', $item->id) }}"
                        class="inline-flex items-center gap-1.5 rounded-xl bg-white px-4 py-2 text-sm font-semibold text-emerald-700 shadow-sm ring-1 ring-admin-border transition hover:ring-emerald-300">
                        <i class="bx bx-edit-alt"></i> Ubah rekening
                    </a>
                </div>
            </article>
        @endforeach
    </div>
@endsection
