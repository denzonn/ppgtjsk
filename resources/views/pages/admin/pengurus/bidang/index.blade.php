@extends('layouts.admin')

@section('title')
    Bidang
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul: pita garis miring --}}
        <header
            class="flex flex-col justify-between gap-4 rounded-xl bg-admin-ink bg-[repeating-linear-gradient(135deg,rgba(255,255,255,0.05)_0_12px,transparent_12px_24px)] p-5 text-white sm:flex-row sm:items-end">
            <div class="flex flex-col gap-1">
                <a href="{{ route('pengurus.index') }}" class="inline-flex items-center gap-1 text-xs font-medium text-ink-200 hover:text-white">
                    <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">arrow_back</span> Pengurus
                </a>
                <h1 class="text-xl font-bold tracking-tight">Bidang Pelayanan</h1>
                <p class="text-sm text-ink-200">Foto bidang tampil di bagian "Pengurus PPGT" beranda.</p>
            </div>
            <a href="{{ route('bidang.create') }}"
                class="inline-flex items-center gap-1.5 self-start rounded-lg bg-white px-3.5 py-2 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-light sm:self-auto">
                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">add</span> Tambah Bidang
            </a>
        </header>

        @if (session('error'))
            <div class="rounded-xl p-4 bg-danger-50 text-danger-700">{{ session('error') }}</div>
        @endif
        @if ($bidang->isEmpty() && \App\Models\Periode::aktif()?->sebelumnya())
            <form action="{{ route('bidang.salin-format') }}" method="POST">
                @csrf
                <button type="submit" class="rounded-lg border border-admin-border bg-white px-3.5 py-2 text-xs font-semibold text-admin-heading hover:bg-admin-light">Pakai format periode sebelumnya</button>
            </form>
        @endif

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($bidang as $item)
                <article class="group overflow-hidden rounded-xl border border-admin-border bg-white">
                    <div class="relative aspect-video overflow-hidden">
                        <img src="{{ $item->foto_bidang }}" alt="" class="size-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <span class="absolute bottom-0 left-0 rounded-tr-xl bg-white py-1.5 pl-4 pr-3 font-mono text-xs font-semibold text-admin">#{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex items-center gap-2 p-4">
                        <h2 class="flex-1 text-sm font-bold">{{ $item->nama_bidang }}@if ($item->maksimal_orang) <span class="font-normal text-admin-text">(maks {{ $item->maksimal_orang }})</span>@endif</h2>
                        <a href="{{ route('bidang.edit', $item->id) }}" title="Ubah"
                            class="flex size-8 items-center justify-center rounded-lg text-admin-text hover:bg-admin-body hover:text-admin-heading">
                            <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">edit</span></a>
                        <form action="{{ route('bidang.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="flex size-8 items-center justify-center rounded-lg text-admin-text hover:bg-danger-50 hover:text-danger-600">
                                <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">delete</span></button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
