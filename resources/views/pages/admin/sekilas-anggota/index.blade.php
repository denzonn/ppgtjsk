@extends('layouts.admin')

@section('title')
    Sekilas Anggota
@endsection

@section('content')
    {{-- Header: papan gabus --}}
    <header class="mb-10 flex items-center gap-5">
        <span class="grid size-16 rotate-[-6deg] place-items-center rounded-2xl bg-lime-300 text-3xl text-lime-900 shadow-lg shadow-lime-300/50">
            <i class="bx bx-note"></i>
        </span>
        <div>
            <h1 class="text-3xl font-extrabold text-admin-heading">Sekilas Anggota</h1>
            <p class="text-slate-500">Catatan singkat yang muncul di kotak "Sekilas Info" pada beranda.</p>
        </div>
    </header>

    <div
        class="grid gap-8 rounded-3xl bg-[#c9a77c] bg-[radial-gradient(rgba(0,0,0,0.08)_1px,transparent_1px)] bg-[length:6px_6px] p-6 shadow-inner sm:grid-cols-2 md:p-10 xl:grid-cols-3">
        @forelse ($data as $item)
            @php($tone = ['bg-lime-200', 'bg-yellow-200', 'bg-pink-200', 'bg-sky-200'][$loop->index % 4])
            <article
                class="relative flex min-h-56 flex-col p-6 pt-8 shadow-[0_12px_20px_-8px_rgba(0,0,0,0.35)] transition hover:rotate-0 hover:scale-[1.02] {{ $tone }} {{ $loop->even ? 'rotate-2' : '-rotate-2' }}">
                <span class="absolute -top-3 left-1/2 size-6 -translate-x-1/2 rounded-full bg-rose-500 shadow-md ring-4 ring-rose-300/60"></span>
                <div class="rich-text flex-1 font-medium text-slate-800">{!! $item->description !!}</div>
                <a href="{{ route('sekilas-anggota.edit', $item->id) }}"
                    class="mt-4 inline-flex items-center gap-1 self-end text-sm font-bold text-slate-700 underline decoration-2 underline-offset-4 hover:text-black">
                    <i class="bx bx-pencil"></i> Ubah catatan
                </a>
            </article>
        @empty
            <p class="col-span-full p-10 text-center font-semibold text-white">Belum ada catatan.</p>
        @endforelse
    </div>
@endsection
