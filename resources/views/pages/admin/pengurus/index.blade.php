@extends('layouts.admin')

@section('title')
    Pengurus
@endsection

@section('content')
    {{-- Header: judul + tiga pintasan --}}
    <header class="mb-10 grid gap-4 lg:grid-cols-[1.4fr_1fr_1fr_1fr]">
        <div class="rounded-3xl bg-amber-400 p-6 text-amber-950">
            <i class="bx bx-sitemap text-4xl"></i>
            <h1 class="mt-2 text-2xl font-extrabold">Struktur Pengurus</h1>
            <p class="text-sm text-amber-900/80">{{ $pengurus->count() }} orang di {{ $pengurus->pluck('bidangs_id')->unique()->count() }} bidang</p>
        </div>
        @foreach ([['jabatan.index', 'bx-medal', 'Kelola Jabatan', 'Ketua, sekretaris, anggota…'], ['bidang.index', 'bx-layer', 'Kelola Bidang', 'Kelompok kerja & fotonya'], ['pengurus.create', 'bx-user-plus', 'Tambah Pengurus', 'Masukkan orang baru']] as [$route, $icon, $title, $desc])
            <a href="{{ route($route) }}"
                class="group flex flex-col justify-between rounded-3xl bg-white p-6 shadow-sm ring-1 ring-admin-border transition hover:-translate-y-1 hover:bg-amber-50 hover:ring-amber-300">
                <span class="grid size-12 place-items-center rounded-2xl bg-amber-100 text-2xl text-amber-700 transition group-hover:bg-amber-400 group-hover:text-amber-950"><i class="bx {{ $icon }}"></i></span>
                <span class="mt-6">
                    <span class="flex items-center justify-between font-bold text-admin-heading">{{ $title }} <i class="bx bx-right-arrow-alt text-xl transition group-hover:translate-x-1"></i></span>
                    <span class="text-sm text-slate-500">{{ $desc }}</span>
                </span>
            </a>
        @endforeach
    </header>

    <label class="mb-8 flex max-w-md items-center gap-3 rounded-full bg-white px-5 py-3 shadow-sm ring-1 ring-admin-border focus-within:ring-2 focus-within:ring-amber-400">
        <i class="bx bx-search text-xl text-slate-400"></i>
        <input type="search" data-filter="#struktur" placeholder="Cari nama atau jabatan…" class="w-full bg-transparent outline-none">
    </label>

    {{-- Per bidang --}}
    <div id="struktur" class="space-y-10">
        @forelse ($pengurus->groupBy(fn($p) => $p->bidang->nama_bidang ?? 'Tanpa Bidang') as $bidang => $anggota)
            <section>
                <h2 class="mb-4 flex items-center gap-3">
                    <span class="rounded-full bg-amber-400 px-4 py-1.5 text-sm font-bold text-amber-950">{{ $bidang }}</span>
                    <span class="h-0.5 flex-1 rounded bg-linear-to-r from-amber-300 to-transparent"></span>
                    <span class="text-sm text-slate-400">{{ $anggota->count() }} orang</span>
                </h2>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                    @foreach ($anggota as $item)
                        <article data-item class="group relative rounded-2xl bg-white p-5 pt-8 text-center shadow-sm ring-1 ring-admin-border transition hover:ring-amber-300">
                            <span class="absolute left-1/2 top-0 h-3 w-14 -translate-x-1/2 rounded-b-lg bg-amber-300"></span>
                            <img src="{{ $item->foto }}" alt="{{ $item->nama_anggota }}"
                                class="mx-auto size-24 rounded-full object-cover ring-4 ring-amber-100">
                            <h3 class="mt-3 font-bold text-admin-heading">{{ $item->nama_anggota }}</h3>
                            <p class="mt-1 inline-block rounded-full bg-slate-100 px-3 py-0.5 text-xs font-semibold text-slate-600">{{ $item->jabatan->nama_jabatan ?? '-' }}</p>
                            <div class="mt-4 flex justify-center gap-2 border-t border-dashed border-admin-border pt-4">
                                <a href="{{ route('pengurus.edit', $item->id) }}"
                                    class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sm font-semibold text-amber-700 hover:bg-amber-50"><i class="bx bx-edit-alt"></i> Ubah</a>
                                <form action="{{ route('pengurus.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sm font-semibold text-rose-600 hover:bg-rose-50"><i class="bx bx-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @empty
            <p class="rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada pengurus.</p>
        @endforelse
    </div>
@endsection
