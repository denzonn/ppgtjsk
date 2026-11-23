@extends('layouts.admin')

@section('title')
    Profil PPGT
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        {{-- Header: tengah dengan garis waktu --}}
        <header class="mb-12 text-center">
            <span class="mx-auto grid size-16 place-items-center rounded-full bg-violet-100 text-3xl text-violet-600 ring-8 ring-violet-50"><i class="bx bx-history"></i></span>
            <h1 class="mt-4 text-3xl font-extrabold text-admin-heading">Sejarah & Profil per Periode</h1>
            <p class="mt-1 text-slate-500">Setiap periode punya foto pengurus dan kisahnya sendiri di halaman Profil.</p>
            <a href="{{ route('profil-ppgt.create') }}"
                class="mt-5 inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 font-semibold text-white shadow-lg shadow-violet-600/30 hover:bg-violet-700">
                <i class="bx bx-plus"></i> Tambah Periode
            </a>
        </header>

        <ol class="relative space-y-12 before:absolute before:inset-y-0 before:left-5 before:w-1 before:rounded before:bg-linear-to-b before:from-violet-300 before:to-violet-50 md:before:left-1/2 md:before:-translate-x-1/2">
            @forelse ($profil as $item)
                <li class="relative grid items-center gap-6 pl-14 md:grid-cols-2 md:pl-0">
                    <span class="absolute left-0 top-0 z-10 grid size-11 place-items-center rounded-full bg-violet-600 text-sm font-bold text-white ring-8 ring-admin-body md:left-1/2 md:top-1/2 md:-translate-x-1/2 md:-translate-y-1/2">
                        {{ $loop->iteration }}
                    </span>
                    <img src="{{ Storage::url($item->photo) }}" alt=""
                        class="aspect-video w-full rounded-3xl object-cover shadow-lg {{ $loop->even ? 'md:order-2 md:ml-8' : 'md:mr-8' }}">
                    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-admin-border {{ $loop->even ? 'md:order-1 md:mr-8' : 'md:ml-8' }}">
                        <p class="text-sm font-bold uppercase tracking-wider text-violet-600">Periode</p>
                        <h2 class="text-2xl font-extrabold text-admin-heading">{{ $item->periode }}</h2>
                        <p class="mt-2 line-clamp-4 text-sm text-slate-500">{{ strip_tags($item->content) }}</p>
                        <a href="{{ route('profil-ppgt.edit', $item->id) }}"
                            class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold text-violet-600 hover:underline"><i class="bx bx-edit-alt"></i> Ubah periode ini</a>
                    </div>
                </li>
            @empty
                <li class="rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada periode.</li>
            @endforelse
        </ol>
    </div>
@endsection
