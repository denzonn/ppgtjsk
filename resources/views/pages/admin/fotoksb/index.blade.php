@extends('layouts.admin')

@section('title')
    Foto KSB
@endsection

@section('content')
    {{-- Header: tipografi besar ala poster --}}
    <header class="mb-10 text-center">
        <p class="text-sm font-bold uppercase tracking-[0.4em] text-rose-500">Ketua · Sekretaris · Wakil · Bendahara</p>
        <h1 class="mt-2 bg-linear-to-r from-rose-500 via-fuchsia-500 to-indigo-500 bg-clip-text text-5xl font-black tracking-tight text-transparent md:text-6xl">K S W B</h1>
        <p class="mx-auto mt-3 max-w-xl text-slate-500">Foto pimpinan yang tampil sebagai galeri melebar di beranda. Arahkan kursor untuk melihat motto.</p>
    </header>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($data as $item)
            <article class="group relative aspect-[3/4] overflow-hidden rounded-[2rem] bg-slate-900 shadow-xl shadow-slate-300/50">
                <img src="{{ $item->foto }}" alt="{{ $item->nama }}"
                    class="absolute inset-0 size-full object-cover transition duration-700 group-hover:scale-110 group-hover:opacity-40">
                <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                <span class="absolute left-5 top-5 rounded-full bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wider text-rose-600 backdrop-blur">{{ $item->jabatan }}</span>
                <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                    <h2 class="text-xl font-extrabold leading-tight">{{ $item->nama }}</h2>
                    <div class="rich-text grid grid-rows-[0fr] text-sm italic text-white/80 transition-all duration-500 group-hover:mt-2 group-hover:grid-rows-[1fr]">
                        <div class="overflow-hidden">{!! $item->motto !!}</div>
                    </div>
                    <a href="{{ route('foto-ksb.edit', $item->id) }}"
                        class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-white px-4 py-2 text-sm font-bold text-slate-900 transition hover:bg-rose-500 hover:text-white">
                        <i class="bx bx-camera"></i> Ganti foto / data
                    </a>
                </div>
            </article>
        @endforeach
    </div>
@endsection
