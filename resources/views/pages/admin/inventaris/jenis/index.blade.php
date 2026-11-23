@extends('layouts.admin')

@section('title')
    Jenis Inventaris
@endsection

@section('content')
    <div class="grid gap-8 lg:grid-cols-[280px_1fr]">
        {{-- Header vertikal --}}
        <aside class="rounded-3xl bg-stone-800 p-6 text-stone-100 lg:self-start">
            <a href="{{ route('inventaris.index') }}" class="inline-flex items-center gap-1 text-sm text-stone-400 hover:text-white"><i class="bx bx-arrow-back"></i> Gudang</a>
            <i class="bx bx-category-alt mt-6 block text-5xl text-amber-400"></i>
            <h1 class="mt-2 text-2xl font-extrabold">Jenis Inventaris</h1>
            <p class="mt-1 text-sm text-stone-400">Kategori untuk mengelompokkan barang di gudang.</p>
            <a href="{{ route('jenis-inventaris.create') }}"
                class="mt-6 flex items-center justify-center gap-2 rounded-xl bg-amber-400 py-3 font-bold text-stone-900 hover:bg-amber-300">
                <i class="bx bx-plus"></i> Jenis baru
            </a>
        </aside>

        {{-- Rak --}}
        <div class="rounded-3xl bg-stone-100 p-6 ring-1 ring-stone-200">
            <div class="grid gap-x-4 gap-y-8 sm:grid-cols-2 xl:grid-cols-3">
                @forelse ($jenisInventaris as $item)
                    <div class="group relative">
                        <div class="flex items-center gap-3 rounded-xl bg-white p-4 shadow-sm ring-1 ring-stone-200 transition group-hover:-translate-y-1">
                            <span class="grid size-11 place-items-center rounded-lg bg-amber-100 font-mono text-lg font-black text-amber-700">{{ $loop->iteration }}</span>
                            <span class="flex-1 font-bold text-stone-800">{{ $item->nama }}</span>
                            <a href="{{ route('jenis-inventaris.edit', $item->id) }}" title="Ubah" class="text-stone-400 hover:text-amber-600"><i class="bx bx-edit-alt text-lg"></i></a>
                            <form action="{{ route('jenis-inventaris.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                    class="text-stone-400 hover:text-rose-600"><i class="bx bx-trash text-lg"></i></button>
                            </form>
                        </div>
                        {{-- Papan rak di bawah kartu --}}
                        <div class="mx-1 h-2.5 rounded-b-md bg-linear-to-b from-stone-400 to-stone-500 shadow-md"></div>
                    </div>
                @empty
                    <p class="col-span-full p-10 text-center text-stone-400">Belum ada jenis.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
