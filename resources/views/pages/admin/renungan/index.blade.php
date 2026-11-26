@extends('layouts.admin')

@section('title')
    Renungan Harian
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul --}}
        <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
            <div>
                <p class="font-serif text-sm italic text-bronze-500">“Firman-Mu itu pelita bagi kakiku”</p>
                <h1 class="text-xl font-bold tracking-tight">Renungan Harian</h1>
                <p class="text-sm text-admin-text">Renungan terbaru tampil di beranda bersama videonya.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 self-start rounded-lg border border-admin-border bg-white px-3 py-1.5 text-xs font-medium text-admin-text sm:self-auto">
                <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">menu_book</span>
                {{ $renungan->count() }} renungan
            </span>
        </div>

        {{-- Kartu majalah --}}
        <div class="flex flex-col gap-4">
            @forelse ($renungan as $item)
                @php
                    // ID video dari URL embed / watch / youtu.be untuk thumbnail.
                    preg_match('~(?:embed/|v=|youtu\.be/)([\w-]{11})~', $item->url_youtube, $m);
                    $thumb = isset($m[1]) ? "https://img.youtube.com/vi/{$m[1]}/hqdefault.jpg" : null;
                @endphp
                <article
                    class="grid overflow-hidden rounded-xl border bg-white md:grid-cols-[minmax(0,2fr)_minmax(0,3fr)] {{ $loop->first ? 'border-admin ring-1 ring-admin' : 'border-admin-border' }}">
                    <a href="{{ $item->url_youtube }}" target="_blank" class="group relative block aspect-video bg-admin-body md:aspect-auto">
                        @if ($thumb)
                            <img src="{{ $thumb }}" alt="" class="absolute inset-0 size-full object-cover">
                        @endif
                        <span class="absolute inset-0 grid place-items-center bg-admin-ink/20 transition-colors group-hover:bg-admin-ink/40">
                            <span class="grid size-12 place-items-center rounded-full bg-white text-admin transition-transform group-hover:scale-110">
                                <span class="material-symbols-outlined text-[26px]! [font-variation-settings:'FILL'_1]" aria-hidden="true">play_arrow</span>
                            </span>
                        </span>
                        @if ($loop->first)
                            <span class="absolute left-3 top-3 rounded-full bg-admin px-2.5 py-0.5 text-[11px] font-semibold text-white">Tampil di beranda</span>
                        @endif
                    </a>
                    <div class="flex flex-col gap-2 p-5 md:p-6">
                        <blockquote class="border-l-2 border-bronze-400 pl-3 font-serif text-base italic text-bronze-600">{{ $item->ayat }}</blockquote>
                        <h2 class="text-lg font-bold">{{ $item->judul }}</h2>
                        <p class="line-clamp-3 text-sm text-admin-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 320) }}</p>
                        <div class="mt-auto flex items-center justify-between gap-2 border-t border-admin-border pt-3">
                            <span class="font-mono text-[11px] text-admin-text">{{ $item->updated_at?->locale('id')->isoFormat('D MMM YYYY') }}</span>
                            <a href="{{ route('renungan-harian.edit', $item->id) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-admin px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-admin-dark">
                                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">edit</span> Tulis ulang
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <p class="rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada renungan.</p>
            @endforelse
        </div>
    </div>
@endsection
