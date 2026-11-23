@extends('layouts.admin')

@section('title')
    Renungan Harian
@endsection

@section('content')
    {{-- Header: judul gaya editorial --}}
    <header class="mb-8 flex flex-wrap items-end justify-between gap-4 border-b-4 border-double border-amber-300 pb-6">
        <div>
            <p class="font-serif text-sm italic text-amber-600">“Firman-Mu itu pelita bagi kakiku”</p>
            <h1 class="font-serif text-4xl font-bold text-admin-heading md:text-5xl">Renungan Harian</h1>
        </div>
        <p class="text-sm text-slate-500">Renungan terbaru tampil di beranda bersama videonya.</p>
    </header>

    <div class="space-y-6">
        @forelse ($renungan as $item)
            @php
                // Ambil ID video dari URL embed / watch / youtu.be untuk thumbnail.
                preg_match('~(?:embed/|v=|youtu\.be/)([\w-]{11})~', $item->url_youtube, $m);
                $thumb = isset($m[1]) ? "https://img.youtube.com/vi/{$m[1]}/hqdefault.jpg" : null;
            @endphp
            <article
                class="grid overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border md:grid-cols-[minmax(0,2fr)_minmax(0,3fr)] {{ $loop->first ? 'ring-2 ring-amber-300' : '' }}">
                <a href="{{ $item->url_youtube }}" target="_blank"
                    class="group relative block aspect-video bg-linear-to-br from-amber-200 to-orange-300 md:aspect-auto">
                    @if ($thumb)
                        <img src="{{ $thumb }}" alt="" class="absolute inset-0 size-full object-cover">
                    @endif
                    <span class="absolute inset-0 grid place-items-center bg-black/20 transition group-hover:bg-black/40">
                        <span class="grid size-16 place-items-center rounded-full bg-white/90 text-3xl text-red-600 shadow-xl transition group-hover:scale-110">
                            <i class="bx bx-play"></i>
                        </span>
                    </span>
                    @if ($loop->first)
                        <span class="absolute left-4 top-4 rounded-full bg-amber-400 px-3 py-1 text-xs font-bold uppercase tracking-wider text-amber-950">Tampil di beranda</span>
                    @endif
                </a>
                <div class="flex flex-col p-6 md:p-8">
                    <blockquote class="mb-3 border-l-4 border-amber-400 pl-3 font-serif text-lg italic text-amber-700">{{ $item->ayat }}</blockquote>
                    <h2 class="text-2xl font-bold text-admin-heading">{{ $item->judul }}</h2>
                    <p class="mt-3 line-clamp-4 text-slate-500">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 320) }}</p>
                    <div class="mt-auto pt-6">
                        <a href="{{ route('renungan-harian.edit', $item->id) }}"
                            class="inline-flex items-center gap-2 rounded-full bg-amber-400 px-5 py-2.5 text-sm font-bold text-amber-950 transition hover:bg-amber-300">
                            <i class="bx bx-pencil"></i> Tulis ulang renungan
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <p class="rounded-3xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada renungan.</p>
        @endforelse
    </div>
@endsection
