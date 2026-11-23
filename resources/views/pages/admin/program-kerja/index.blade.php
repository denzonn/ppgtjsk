@extends('layouts.admin')

@section('title')
    Program Kerja
@endsection

@section('content')
    {{-- Header: ringkas dengan statistik --}}
    <header class="mb-8 flex flex-wrap items-center gap-6">
        <div class="flex-1">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-violet-500">Papan Kerja</p>
            <h1 class="text-3xl font-extrabold text-admin-heading">Program Kerja</h1>
        </div>
        <div class="flex gap-3">
            <div class="rounded-2xl bg-white px-5 py-3 text-center shadow-sm ring-1 ring-admin-border">
                <p class="text-2xl font-black text-violet-600">{{ $program->count() }}</p>
                <p class="text-xs text-slate-400">program</p>
            </div>
            <div class="rounded-2xl bg-white px-5 py-3 text-center shadow-sm ring-1 ring-admin-border">
                <p class="text-2xl font-black text-violet-600">{{ $program->pluck('bidang_id')->unique()->count() }}</p>
                <p class="text-xs text-slate-400">bidang</p>
            </div>
        </div>
        <a href="{{ route('program-kerja.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-violet-600 px-5 py-3 font-semibold text-white shadow-lg shadow-violet-600/30 transition hover:bg-violet-700">
            <i class="bx bx-task text-xl"></i> Tambah Program
        </a>
    </header>

    {{-- Kolom kanban per bidang --}}
    <div class="-mx-4 flex snap-x gap-5 overflow-x-auto px-4 pb-4 md:-mx-8 md:px-8">
        @forelse ($program->groupBy(fn($p) => $p->bidang->nama_bidang ?? 'Tanpa Bidang') as $bidang => $items)
            <section class="w-80 shrink-0 snap-start rounded-3xl bg-violet-50/70 p-4 ring-1 ring-violet-100">
                <h2 class="mb-4 flex items-center gap-2 px-1 font-bold text-violet-900">
                    <span class="size-2.5 rounded-full bg-violet-500"></span> {{ $bidang }}
                    <span class="ml-auto rounded-full bg-white px-2.5 py-0.5 text-xs text-violet-600 ring-1 ring-violet-200">{{ $items->count() }}</span>
                </h2>
                <div class="space-y-3">
                    @foreach ($items as $item)
                        <article class="group rounded-2xl bg-white p-4 shadow-sm ring-1 ring-admin-border transition hover:shadow-md hover:ring-violet-300">
                            <h3 class="font-bold text-admin-heading">{{ $item->name }}</h3>
                            <p class="mt-1 line-clamp-3 text-sm text-slate-500">{{ strip_tags($item->description) }}</p>
                            <div class="mt-3 flex justify-end gap-1 opacity-0 transition group-hover:opacity-100 max-md:opacity-100">
                                <a href="{{ route('program-kerja.edit', $item->id) }}" title="Ubah"
                                    class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-violet-50 hover:text-violet-600"><i class="bx bx-edit-alt"></i></a>
                                <form action="{{ route('program-kerja.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-rose-50 hover:text-rose-600"><i class="bx bx-trash"></i></button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @empty
            <p class="w-full rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada program kerja.</p>
        @endforelse
    </div>
@endsection
