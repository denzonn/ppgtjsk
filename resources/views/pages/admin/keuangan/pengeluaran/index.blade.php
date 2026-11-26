@extends('layouts.admin')

@section('title')
    Pengeluaran
@endsection

@section('content')
    {{-- Header: total di kanan --}}
    <header class="mb-8 flex flex-wrap items-stretch gap-4">
        <div class="flex flex-1 items-center gap-4 rounded-xl bg-white p-6 border border-admin-border">
            <a href="{{ route('keuangan') }}" title="Kembali ke Keuangan" class="text-2xl text-slate-400 hover:text-danger-600"><i class="bx bx-arrow-back"></i></a>
            <div>
                <h1 class="text-2xl font-semibold text-admin-heading">Pengeluaran</h1>
                <p class="text-sm text-slate-500">Setiap struk pengeluaran kas PPGT.</p>
            </div>
            <a href="{{ route('pengeluaran.create') }}"
                class="ml-auto inline-flex items-center gap-2 rounded-lg bg-danger-600 px-5 py-3 font-semibold text-white hover:bg-danger-700">
                <i class="bx bx-receipt text-xl"></i> Catat
            </a>
        </div>
        <div class="rounded-xl bg-danger-600 px-8 py-6 text-white">
            <p class="text-sm text-danger-100">Total keluar</p>
            <p class="text-3xl font-semibold">Rp {{ number_format($pengeluaran->sum('jumlah'), 0, ',', '.') }}</p>
        </div>
    </header>

    {{-- Struk --}}
    <div class="grid gap-x-6 gap-y-10 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
        @forelse ($pengeluaran->sortByDesc('tanggal') as $item)
            <article
                class="relative bg-white px-6 pb-8 pt-6 font-mono text-sm [mask:conic-gradient(from_-45deg_at_bottom,#0000,#000_1deg_89deg,#0000_90deg)_50%/16px_100%]">
                <p class="text-center text-xs uppercase tracking-[0.3em] text-slate-400">— Struk Keluar —</p>
                <p class="mt-1 text-center text-xs text-slate-400">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMM YYYY') }}</p>
                <p class="my-4 border-y-2 border-dashed border-slate-200 py-3 font-sans font-semibold text-admin-heading">{{ $item->keterangan }}</p>
                <p class="flex justify-between text-base"><span class="text-slate-400">TOTAL</span> <b class="text-danger-600">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</b></p>
                <div class="mt-4 flex justify-end gap-1 font-sans">
                    <a href="{{ route('pengeluaran.edit', $item->id) }}"
                        class="rounded-xl px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-100"><i class="bx bx-edit-alt"></i> Ubah</a>
                    <form action="{{ route('pengeluaran.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                            class="rounded-xl px-3 py-1.5 text-xs font-semibold text-danger-600 hover:bg-danger-50"><i class="bx bx-trash"></i> Hapus</button>
                    </form>
                </div>
            </article>
        @empty
            <p class="col-span-full rounded-xl bg-white p-10 text-center text-slate-400 border border-admin-border">Belum ada pengeluaran.</p>
        @endforelse
    </div>
@endsection
