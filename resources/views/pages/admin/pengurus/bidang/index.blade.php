@extends('layouts.admin')

@section('title')
    Bidang
@endsection

@section('content')
    {{-- Header: garis miring --}}
    <header
        class="relative mb-8 overflow-hidden rounded-3xl bg-orange-600 bg-[repeating-linear-gradient(135deg,rgba(255,255,255,0.08)_0_14px,transparent_14px_28px)] p-6 text-white md:p-8">
        <a href="{{ route('pengurus.index') }}" class="mb-4 inline-flex items-center gap-1 text-sm font-semibold text-orange-100 hover:text-white">
            <i class="bx bx-arrow-back"></i> Pengurus
        </a>
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black">Bidang Pelayanan</h1>
                <p class="text-orange-100">Foto bidang tampil di bagian "Pengurus PPGT" beranda.</p>
            </div>
            <a href="{{ route('bidang.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 font-bold text-orange-700 shadow-lg transition hover:bg-orange-50">
                <i class="bx bx-plus-circle text-xl"></i> Tambah Bidang
            </a>
        </div>
    </header>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($bidang as $item)
            <article class="group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
                <div class="relative aspect-video overflow-hidden">
                    <img src="{{ Storage::url($item->foto_bidang) }}" alt="" class="size-full object-cover transition duration-500 group-hover:scale-105">
                    <span class="absolute bottom-0 left-0 rounded-tr-3xl bg-white py-3 pl-5 pr-6 font-mono text-sm font-bold text-orange-600">#{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex items-center gap-3 p-5">
                    <h2 class="flex-1 text-lg font-bold text-admin-heading">{{ $item->nama_bidang }}</h2>
                    <a href="{{ route('bidang.edit', $item->id) }}" title="Ubah"
                        class="grid size-10 place-items-center rounded-xl bg-orange-50 text-orange-600 hover:bg-orange-100"><i class="bx bx-edit-alt text-lg"></i></a>
                    <form action="{{ route('bidang.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                            class="grid size-10 place-items-center rounded-xl bg-slate-50 text-slate-500 hover:bg-rose-50 hover:text-rose-600"><i class="bx bx-trash text-lg"></i></button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
@endsection
