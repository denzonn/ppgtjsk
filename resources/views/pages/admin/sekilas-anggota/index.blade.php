@extends('layouts.admin')

@section('title')
    Sekilas Anggota
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul --}}
        <div class="flex items-center gap-3">
            <span class="grid size-10 -rotate-6 place-items-center rounded-lg bg-bronze-50 text-bronze-500 ring-1 ring-bronze-200">
                <span class="material-symbols-outlined text-[20px]!" aria-hidden="true">sticky_note_2</span>
            </span>
            <div>
                <h1 class="text-xl font-bold tracking-tight">Sekilas Anggota</h1>
                <p class="text-sm text-admin-text">Catatan singkat yang muncul di kotak "Sekilas Info" pada beranda.</p>
            </div>
        </div>

        {{-- Papan catatan --}}
        <div class="grid gap-6 rounded-xl border border-admin-border bg-white bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] bg-[length:14px_14px] p-6 sm:grid-cols-2 md:p-8 xl:grid-cols-3">
            @forelse ($data as $item)
                @php($tone = ['bg-ink-50 ring-ink-100', 'bg-bronze-50 ring-bronze-200', 'bg-white ring-admin-border'][$loop->index % 3])
                <article
                    class="relative flex min-h-48 flex-col rounded-lg p-5 pt-7 ring-1 transition-transform hover:rotate-0 hover:scale-[1.02] {{ $tone }} {{ $loop->even ? 'rotate-1' : '-rotate-1' }} shadow-[0_10px_18px_-12px_rgba(15,23,42,0.35)]">
                    <span class="absolute -top-2 left-1/2 size-4 -translate-x-1/2 rounded-full ring-4 ring-white {{ $loop->even ? 'bg-bronze-400' : 'bg-admin' }}"></span>
                    <div class="rich-text flex-1 text-sm font-medium text-admin-heading">{!! $item->description !!}</div>
                    <a href="{{ route('sekilas-anggota.edit', $item->id) }}"
                        class="mt-3 inline-flex items-center gap-1 self-end rounded-lg px-2 py-1 text-xs font-semibold text-admin transition-colors hover:bg-white">
                        <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">edit</span> Ubah catatan
                    </a>
                </article>
            @empty
                <p class="col-span-full p-10 text-center text-sm text-admin-text">Belum ada catatan.</p>
            @endforelse
        </div>
    </div>
@endsection
