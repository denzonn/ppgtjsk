@extends('layouts.admin')

@section('title')
    Foto KSB
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul gaya poster --}}
        <header class="flex flex-col items-center gap-1 text-center">
            <span class="font-mono text-[10px] uppercase tracking-[0.3em] text-bronze-500">Ketua · Sekretaris · Wakil · Bendahara</span>
            <h1 class="text-3xl font-bold tracking-[0.35em] text-admin">KSWB</h1>
            <p class="max-w-xl text-sm text-admin-text">Foto pimpinan yang tampil sebagai galeri melebar di beranda. Arahkan kursor untuk melihat motto.</p>
        </header>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($data as $item)
                <article class="group relative aspect-[3/4] overflow-hidden rounded-xl bg-admin-ink">
                    <img src="{{ $item->foto }}" alt="{{ $item->nama }}"
                        class="absolute inset-0 size-full object-cover transition duration-500 group-hover:scale-105 group-hover:opacity-40">
                    <div class="absolute inset-0 bg-linear-to-t from-black/85 via-black/10 to-transparent"></div>
                    <span class="absolute left-3 top-3 rounded-full bg-white px-2.5 py-0.5 text-[11px] font-semibold text-admin">{{ $item->jabatan }}</span>
                    <div class="absolute inset-x-0 bottom-0 flex flex-col gap-2 p-4 text-white">
                        <h2 class="text-base font-bold leading-tight">{{ $item->nama }}</h2>
                        <div class="rich-text grid grid-rows-[0fr] text-xs italic text-white/80 transition-all duration-500 group-hover:grid-rows-[1fr]">
                            <div class="overflow-hidden">{!! $item->motto !!}</div>
                        </div>
                        <a href="{{ route('foto-ksb.edit', $item->id) }}"
                            class="inline-flex items-center gap-1.5 self-start rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin hover:text-white">
                            <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">photo_camera</span> Ganti foto / data
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
