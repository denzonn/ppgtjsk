@extends('layouts.admin')

@section('title')
    Profil PPGT
@endsection

@section('content')
    <div class="mx-auto flex w-full max-w-5xl flex-col gap-6">
        {{-- Judul tengah --}}
        <header class="flex flex-col items-center gap-2 text-center">
            <span class="grid size-11 place-items-center rounded-full bg-admin-light text-admin ring-4 ring-white">
                <span class="material-symbols-outlined text-[22px]!" aria-hidden="true">history_edu</span>
            </span>
            <div>
                <h1 class="text-xl font-bold tracking-tight">Sejarah & Profil per Periode</h1>
                <p class="text-sm text-admin-text">Setiap periode punya foto pengurus dan kisahnya sendiri di halaman Profil.</p>
            </div>
            <a href="{{ route('profil-ppgt.create') }}"
                class="inline-flex items-center gap-1.5 rounded-lg bg-admin px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-admin-dark">
                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">add</span> Tambah Periode
            </a>
        </header>

        {{-- Garis waktu --}}
        <ol class="relative flex flex-col gap-8 before:absolute before:inset-y-0 before:left-4 before:w-px before:bg-admin-border md:before:left-1/2">
            @forelse ($profil as $item)
                <li class="relative grid items-center gap-4 pl-12 md:grid-cols-2 md:gap-16 md:pl-0">
                    <span class="absolute left-0 top-0 z-10 grid size-8 place-items-center rounded-full bg-admin font-mono text-xs font-semibold text-white ring-4 ring-admin-body md:left-1/2 md:top-1/2 md:-translate-x-1/2 md:-translate-y-1/2">
                        {{ $loop->iteration }}
                    </span>
                    <img src="{{ $item->photo }}" alt=""
                        class="aspect-video w-full rounded-xl border border-admin-border object-cover {{ $loop->even ? 'md:order-2' : '' }}">
                    <div class="flex flex-col gap-1 rounded-xl border border-admin-border bg-white p-5 {{ $loop->even ? 'md:order-1' : '' }}">
                        <span class="font-mono text-[10px] uppercase tracking-wider text-bronze-500">Periode</span>
                        <h2 class="text-base font-bold">{{ $item->periode }}</h2>
                        <p class="line-clamp-4 text-sm text-admin-text">{{ strip_tags($item->content) }}</p>
                        <a href="{{ route('profil-ppgt.edit', $item->id) }}"
                            class="mt-2 inline-flex items-center gap-1 self-start rounded-lg border border-admin-border px-3 py-1.5 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-body">
                            <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">edit</span> Ubah periode
                        </a>
                    </div>
                </li>
            @empty
                <li class="rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada periode.</li>
            @endforelse
        </ol>
    </div>
@endsection
