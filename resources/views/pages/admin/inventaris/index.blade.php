@extends('layouts.admin')

@section('title')
    Inventaris
@endsection

@section('content')
    {{-- Header: gudang dengan aksi di kanan --}}
    <header class="mb-6 flex flex-wrap items-center gap-4 rounded-xl bg-slate-800 p-6 text-white md:p-8">
        <span class="grid size-14 place-items-center rounded-xl bg-white/10 text-3xl"><i class="bx bx-package"></i></span>
        <div class="flex-1">
            <h1 class="text-2xl font-semibold md:text-3xl">Gudang Inventaris</h1>
            <p class="text-slate-300">{{ $inventaris->count() }} jenis barang · {{ number_format($inventaris->sum('jumlah'), 0, ',', '.') }} unit total</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('jenis-inventaris.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2.5 text-sm font-semibold hover:bg-white/20"><i class="bx bx-category"></i> Jenis</a>
            <a href="{{ route('inventaris.print') }}" class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2.5 text-sm font-semibold hover:bg-white/20"><i class="bx bx-printer"></i> Cetak</a>
            <a href="{{ route('inventaris.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-bold text-slate-800 hover:bg-slate-100"><i class="bx bx-plus"></i> Tambah Barang</a>
        </div>
    </header>

    {{-- Filter jenis --}}
    <div class="mb-6 flex flex-wrap items-center gap-2">
        <label class="flex flex-1 items-center gap-2 rounded-lg bg-white px-4 py-2.5 border border-admin-border focus-within:ring-slate-500">
            <i class="bx bx-search text-lg text-slate-400"></i>
            <input type="search" data-filter="#gudang" placeholder="Cari nama, kode, atau jenis…" class="w-full bg-transparent outline-none">
        </label>
    </div>

    <div id="gudang" class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
        @forelse ($inventaris as $item)
            <article data-item class="group overflow-hidden rounded-xl bg-white border border-admin-border transition">
                <div class="relative aspect-square bg-slate-100">
                    <img src="{{ $item->photo }}" alt="" class="size-full object-cover">
                    <span class="absolute left-3 top-3 rounded-lg bg-slate-900/80 px-2 py-1 font-mono text-xs font-bold text-white">{{ $item->kode }}</span>
                    <span class="absolute bottom-3 right-3 grid min-w-14 place-items-center rounded-xl bg-white px-3 py-1.5 text-center">
                        <span class="text-xl font-semibold leading-none text-slate-800">{{ $item->jumlah }}</span>
                        <span class="text-[0.6rem] font-bold uppercase text-slate-400">unit</span>
                    </span>
                </div>
                <div class="p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $item->jenis->nama ?? '-' }}</p>
                    <h2 class="font-bold text-admin-heading">{{ $item->nama }}</h2>
                    <p class="mt-1 line-clamp-2 text-sm text-slate-500">{{ strip_tags($item->keterangan) }}</p>
                    <p class="mt-1 text-xs text-slate-400">Masuk Periode: {{ $item->periode?->label() ?? '-' }}</p>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('inventaris.edit', $item->id) }}"
                            class="flex-1 rounded-xl bg-slate-100 py-2 text-center text-sm font-semibold text-slate-700 hover:bg-slate-200">Ubah</a>
                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="grid h-full w-10 place-items-center rounded-xl text-slate-400 hover:bg-danger-50 hover:text-danger-600"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <p class="col-span-full rounded-xl bg-white p-10 text-center text-slate-400 border border-admin-border">Gudang masih kosong.</p>
        @endforelse
    </div>
@endsection
