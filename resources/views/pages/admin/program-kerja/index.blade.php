@extends('layouts.admin')

@section('title')
    Program Kerja
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul + statistik --}}
        <header class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <div>
                <span class="font-mono text-[10px] uppercase tracking-wider text-admin">Papan Kerja</span>
                <h1 class="text-xl font-bold tracking-tight">Program Kerja</h1>
            </div>
            <div class="flex items-center gap-2">
                @foreach ([[$program->count(), 'program'], [$program->pluck('bidang_id')->unique()->count(), 'bidang']] as [$n, $label])
                    <span class="rounded-lg border border-admin-border bg-white px-3 py-1.5 text-xs text-admin-text">
                        <b class="font-mono text-sm text-admin-heading">{{ $n }}</b> {{ $label }}
                    </span>
                @endforeach
                <a href="{{ route('program-kerja.create') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-admin px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-admin-dark">
                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">add_task</span> Tambah Program
                </a>
            </div>
        </header>

        {{-- Kolom kanban per bidang --}}
        <div class="-mx-6 flex snap-x scroll-px-6 gap-4 overflow-x-auto px-6 pb-3">
            @forelse ($program->groupBy(fn($p) => $p->bidang->nama_bidang ?? 'Tanpa Bidang') as $bidang => $items)
                <section class="flex w-72 shrink-0 snap-start flex-col gap-3 rounded-xl border border-admin-border bg-admin-body/70 p-3">
                    <h2 class="flex items-center gap-2 px-1 text-sm font-bold">
                        <span class="size-2 rounded-full bg-admin"></span> {{ $bidang }}
                        <span class="ml-auto rounded-full bg-white px-2 py-0.5 font-mono text-[11px] text-admin-text ring-1 ring-admin-border">{{ $items->count() }}</span>
                    </h2>
                    @foreach ($items as $item)
                        <article class="group rounded-lg border border-admin-border bg-white p-3.5 transition-colors hover:border-ink-200">
                            <h3 class="text-sm font-bold">{{ $item->name }}</h3>
                            <p class="mt-1 line-clamp-3 text-xs text-admin-text">{{ strip_tags($item->description) }}</p>
                            <div class="mt-2 flex justify-end gap-0.5 opacity-0 transition-opacity group-hover:opacity-100 max-md:opacity-100">
                                <a href="{{ route('program-kerja.edit', $item->id) }}" title="Ubah"
                                    class="flex size-7 items-center justify-center rounded-lg text-admin-text hover:bg-admin-body hover:text-admin-heading">
                                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">edit</span></a>
                                <form action="{{ route('program-kerja.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="flex size-7 items-center justify-center rounded-lg text-admin-text hover:bg-danger-50 hover:text-danger-600">
                                        <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">delete</span></button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </section>
            @empty
                <p class="w-full rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada program kerja.</p>
            @endforelse
        </div>
    </div>
@endsection
