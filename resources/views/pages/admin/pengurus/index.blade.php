@extends('layouts.admin')

@section('title')
    Pengurus
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul + pintasan --}}
        <header class="grid gap-3 lg:grid-cols-[1.3fr_1fr_1fr_1fr]">
            <div class="flex flex-col justify-between gap-3 rounded-xl bg-admin-ink p-5 text-white">
                <span class="font-mono text-[10px] uppercase tracking-wider text-ink-200">Organisasi</span>
                <div>
                    <h1 class="text-xl font-bold tracking-tight">Struktur Pengurus</h1>
                    <p class="text-xs text-ink-200">{{ $pengurus->count() }} orang di {{ $pengurus->pluck('bidangs_id')->unique()->count() }} bidang</p>
                </div>
            </div>
            @foreach ([['jabatan.index', 'military_tech', 'Kelola Jabatan', 'Ketua, sekretaris, anggota…'], ['bidang.index', 'layers', 'Kelola Bidang', 'Kelompok kerja & fotonya'], ['pengurus.create', 'person_add', 'Tambah Pengurus', 'Masukkan orang baru']] as [$route, $icon, $title, $desc])
                <a href="{{ route($route) }}"
                    class="group flex flex-col justify-between gap-4 rounded-xl border border-admin-border bg-white p-4 transition-colors hover:border-ink-200">
                    <span class="grid size-9 place-items-center rounded-lg bg-admin-light text-admin transition-colors group-hover:bg-admin group-hover:text-white">
                        <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">{{ $icon }}</span>
                    </span>
                    <span>
                        <span class="flex items-center justify-between text-sm font-bold">{{ $title }}
                            <span class="material-symbols-outlined text-[16px]! text-admin-text transition-transform group-hover:translate-x-0.5" aria-hidden="true">arrow_forward</span></span>
                        <span class="text-xs text-admin-text">{{ $desc }}</span>
                    </span>
                </a>
            @endforeach
        </header>

        <label class="flex max-w-md items-center gap-2 rounded-lg border border-admin-border bg-white px-3 py-2 focus-within:border-admin">
            <span class="material-symbols-outlined text-[18px]! text-admin-text" aria-hidden="true">search</span>
            <input type="search" data-filter="#struktur" placeholder="Cari nama atau jabatan…" class="w-full bg-transparent text-sm outline-none placeholder:text-admin-text">
        </label>

        {{-- Per bidang --}}
        <div id="struktur" class="flex flex-col gap-6">
            @forelse ($pengurus->groupBy(fn($p) => $p->bidang->nama_bidang ?? 'Tanpa Bidang') as $bidang => $anggota)
                <section class="flex flex-col gap-3">
                    <h2 class="flex items-center gap-3">
                        <span class="rounded-full bg-admin-light px-3 py-1 text-xs font-semibold text-admin">{{ $bidang }}</span>
                        <span class="h-px flex-1 bg-admin-border"></span>
                        <span class="font-mono text-[11px] text-admin-text">{{ $anggota->count() }} orang</span>
                    </h2>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($anggota as $item)
                            <article data-item class="relative flex items-center gap-3 overflow-hidden rounded-xl border border-admin-border bg-white p-3.5 pl-4 transition-colors hover:border-ink-200">
                                <span class="absolute inset-y-0 left-0 w-1 bg-admin"></span>
                                <img src="{{ $item->foto }}" alt="{{ $item->nama_anggota }}" class="size-12 shrink-0 rounded-full object-cover ring-2 ring-admin-light">
                                <div class="min-w-0 flex-1">
                                    <h3 class="truncate text-sm font-bold">{{ $item->nama_anggota }}</h3>
                                    <p class="truncate text-xs text-admin-text">{{ $item->jabatan->nama_jabatan ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <a href="{{ route('pengurus.edit', $item->id) }}" title="Ubah"
                                        class="flex size-7 items-center justify-center rounded-lg text-admin-text hover:bg-admin-body hover:text-admin-heading">
                                        <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">edit</span></a>
                                    <form action="{{ route('pengurus.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                            class="flex size-7 items-center justify-center rounded-lg text-admin-text hover:bg-danger-50 hover:text-danger-600">
                                            <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">delete</span></button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @empty
                <p class="rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada pengurus.</p>
            @endforelse
        </div>
    </div>
@endsection
