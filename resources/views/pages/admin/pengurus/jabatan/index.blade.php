@extends('layouts.admin')

@section('title')
    Jabatan
@endsection

@section('content')
    <div class="mx-auto max-w-4xl">
        {{-- Header: medali --}}
        <header class="mb-8 flex flex-wrap items-center gap-5">
            <a href="{{ route('pengurus.index') }}" title="Kembali ke Pengurus"
                class="grid size-11 place-items-center rounded-full bg-white text-slate-500 shadow-sm ring-1 ring-admin-border hover:text-yellow-600"><i class="bx bx-arrow-back text-xl"></i></a>
            <span class="relative grid size-16 place-items-center rounded-full bg-linear-to-b from-yellow-300 to-amber-500 text-3xl text-white shadow-lg shadow-amber-500/40 ring-4 ring-yellow-100">
                <i class="bx bx-medal"></i>
            </span>
            <div class="flex-1">
                <h1 class="text-2xl font-extrabold text-admin-heading">Daftar Jabatan</h1>
                <p class="text-sm text-slate-500">Dipakai saat menempatkan pengurus ke dalam bidang.</p>
            </div>
        </header>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-admin-border md:p-8">
            <div class="flex flex-wrap gap-3">
                @foreach ($jabatan as $item)
                    <span class="group inline-flex items-center gap-2 rounded-full bg-yellow-50 py-2 pl-4 pr-2 font-semibold text-yellow-900 ring-1 ring-yellow-200 transition hover:bg-yellow-100">
                        <i class="bx bxs-star text-yellow-500"></i>
                        {{ $item->nama_jabatan }}
                        <a href="{{ route('jabatan.edit', $item->id) }}" title="Ubah"
                            class="grid size-7 place-items-center rounded-full text-yellow-700 hover:bg-white"><i class="bx bx-pencil"></i></a>
                        <form action="{{ route('jabatan.destroy', $item->id) }}" method="POST" class="-ml-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="grid size-7 place-items-center rounded-full text-yellow-700 hover:bg-rose-500 hover:text-white"><i class="bx bx-x"></i></button>
                        </form>
                    </span>
                @endforeach
                <a href="{{ route('jabatan.create') }}"
                    class="inline-flex items-center gap-2 rounded-full border-2 border-dashed border-yellow-300 px-4 py-2 font-semibold text-yellow-700 transition hover:border-yellow-500 hover:bg-yellow-50">
                    <i class="bx bx-plus"></i> Jabatan baru
                </a>
            </div>
        </div>
    </div>
@endsection
