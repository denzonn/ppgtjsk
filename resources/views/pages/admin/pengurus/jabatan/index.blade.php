@extends('layouts.admin')

@section('title')
    Jabatan
@endsection

@section('content')
    <div class="mx-auto flex w-full max-w-4xl flex-col gap-5">
        {{-- Judul --}}
        <header class="flex items-center gap-3">
            <a href="{{ route('pengurus.index') }}" title="Kembali ke Pengurus"
                class="flex size-8 items-center justify-center rounded-lg border border-admin-border bg-white text-admin-text hover:text-admin-heading">
                <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">arrow_back</span></a>
            <span class="grid size-10 place-items-center rounded-full bg-bronze-50 text-bronze-500 ring-1 ring-bronze-200">
                <span class="material-symbols-outlined text-[20px]! [font-variation-settings:'FILL'_1]" aria-hidden="true">military_tech</span>
            </span>
            <div>
                <h1 class="text-xl font-bold tracking-tight">Daftar Jabatan</h1>
                <p class="text-sm text-admin-text">Dipakai saat menempatkan pengurus ke dalam bidang.</p>
            </div>
        </header>

        @if (session('error'))
            <div class="rounded-xl p-4 bg-danger-50 text-danger-700">{{ session('error') }}</div>
        @endif
        @if ($jabatan->isEmpty() && \App\Models\Periode::aktif()?->sebelumnya())
            <form action="{{ route('jabatan.salin-format') }}" method="POST">
                @csrf
                <button type="submit" class="rounded-lg border border-admin-border bg-white px-3.5 py-2 text-xs font-semibold text-admin-heading hover:bg-admin-light">Pakai format periode sebelumnya</button>
            </form>
        @endif

        <div class="rounded-xl border border-admin-border bg-white p-5">
            <div class="flex flex-wrap gap-2">
                @foreach ($jabatan as $item)
                    <span class="group inline-flex items-center gap-1.5 rounded-full bg-admin-light py-1 pl-3 pr-1 text-sm font-semibold text-admin">
                        <span class="material-symbols-outlined text-[14px]! text-bronze-400 [font-variation-settings:'FILL'_1]" aria-hidden="true">star</span>
                        {{ $item->nama_jabatan }}
                        <a href="{{ route('jabatan.edit', $item->id) }}" title="Ubah"
                            class="grid size-6 place-items-center rounded-full text-admin hover:bg-white">
                            <span class="material-symbols-outlined text-[14px]!" aria-hidden="true">edit</span></a>
                        <form action="{{ route('jabatan.destroy', $item->id) }}" method="POST" class="-ml-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="grid size-6 place-items-center rounded-full text-admin hover:bg-danger-500 hover:text-white">
                                <span class="material-symbols-outlined text-[14px]!" aria-hidden="true">close</span></button>
                        </form>
                    </span>
                @endforeach
                <a href="{{ route('jabatan.create') }}"
                    class="inline-flex items-center gap-1 rounded-full border border-dashed border-ink-300 px-3 py-1 text-sm font-semibold text-admin transition-colors hover:border-admin hover:bg-admin-light">
                    <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">add</span> Jabatan baru
                </a>
            </div>
        </div>
    </div>
@endsection
