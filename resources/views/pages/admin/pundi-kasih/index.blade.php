@extends('layouts.admin')

@section('title')
    Pundi Kasih
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul --}}
        <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-xl font-bold tracking-tight">Pundi Kasih</h1>
                <p class="text-sm text-admin-text">Rekening yang ditampilkan di beranda. Rekening berisi "-" atau kosong tidak ditampilkan.</p>
            </div>
            <a href="{{ route('site-image.index') }}"
                class="inline-flex items-center gap-1.5 self-start rounded-lg border border-admin-border bg-white px-3 py-1.5 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-body sm:self-auto">
                <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">image</span> Ganti logo bank
            </a>
        </div>

        {{-- Kartu ATM --}}
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($pundiKasih as $item)
                @php($active = $item->no_rek && $item->no_rek !== '-')
                <article class="group flex flex-col gap-3">
                    <div
                        class="relative aspect-[1.586] overflow-hidden rounded-xl bg-linear-to-br from-admin to-admin-ink p-5 text-white transition-transform group-hover:-translate-y-0.5 {{ $active ? '' : 'opacity-60 grayscale' }}">
                        <span class="absolute -right-14 -top-14 size-48 rounded-full bg-white/10"></span>
                        <span class="absolute -bottom-20 right-10 size-48 rounded-full bg-white/5"></span>
                        <div class="relative flex h-full flex-col">
                            <div class="flex items-start justify-between">
                                <img src="{{ \App\Models\SiteImage::bankLogo($item->bank->name) }}" alt="{{ $item->bank->name }}"
                                    class="h-7 rounded-md bg-white object-contain px-2 py-1">
                                <span class="material-symbols-outlined rotate-90 text-[22px]! text-white/60" aria-hidden="true">wifi</span>
                            </div>
                            <span class="mt-4 h-8 w-11 rounded-md bg-linear-to-br from-bronze-200 to-bronze-400"></span>
                            <p class="mt-auto font-mono text-lg tracking-[0.15em] md:text-xl">
                                {{ !$active ? '•••• •••• ••••' : (ctype_digit($item->no_rek) ? trim(chunk_split($item->no_rek, 4, ' ')) : $item->no_rek) }}
                            </p>
                            <div class="mt-2 flex items-end justify-between">
                                <div>
                                    <p class="font-mono text-[9px] uppercase tracking-widest text-ink-200">Atas nama</p>
                                    <p class="text-sm font-semibold uppercase">{{ $item->atas_nama ?: '—' }}</p>
                                </div>
                                <p class="text-base font-bold italic">{{ strtoupper($item->bank->name) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-1">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $active ? 'bg-success-50 text-success-600' : 'bg-admin-body text-admin-text' }}">
                            <span class="size-1.5 rounded-full {{ $active ? 'bg-success-500' : 'bg-slate-400' }}"></span>
                            {{ $active ? 'Tampil di beranda' : 'Disembunyikan' }}
                        </span>
                        <a href="{{ route('pundi-kasih.edit', $item->id) }}"
                            class="inline-flex items-center gap-1 rounded-lg border border-admin-border bg-white px-3 py-1.5 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-body">
                            <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">edit</span> Ubah rekening
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
