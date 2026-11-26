@extends('layouts.admin')

@section('title')
    Dokumen
@endsection

@section('content')
    <div class="overflow-hidden rounded-xl border border-admin-border bg-white">
        {{-- Toolbar file explorer --}}
        <header class="flex flex-wrap items-center gap-3 border-b border-admin-border bg-admin-body/60 px-5 py-3">
            <span class="grid size-9 place-items-center rounded-lg bg-admin text-white">
                <span class="material-symbols-outlined text-[18px]! [font-variation-settings:'FILL'_1]" aria-hidden="true">folder_open</span>
            </span>
            <div class="flex-1">
                <h1 class="text-base font-bold">Dokumen PPGT</h1>
                <p class="text-xs text-admin-text">Bisa diunduh pengunjung di halaman "Document".</p>
            </div>
            <label class="flex items-center gap-1.5 rounded-lg border border-admin-border bg-white px-2.5 py-1.5 focus-within:border-admin">
                <span class="material-symbols-outlined text-[16px]! text-admin-text" aria-hidden="true">search</span>
                <input type="search" data-filter="#files" placeholder="Cari file…" class="w-36 bg-transparent text-xs outline-none placeholder:text-admin-text">
            </label>
            <a href="{{ route('document.create') }}"
                class="inline-flex items-center gap-1.5 rounded-lg bg-admin px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-admin-dark">
                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">upload</span> Unggah
            </a>
        </header>

        <div id="files" class="grid grid-cols-2 gap-1 p-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
            @forelse ($dokumen as $item)
                @php
                    $ext = strtolower(pathinfo($item->getRawOriginal('file'), PATHINFO_EXTENSION));
                    [$icon, $tone] = match (true) {
                        $ext === 'pdf' => ['picture_as_pdf', 'bg-danger-50 text-danger-500'],
                        in_array($ext, ['doc', 'docx']) => ['description', 'bg-admin-light text-admin'],
                        in_array($ext, ['xls', 'xlsx', 'csv']) => ['table_chart', 'bg-success-50 text-success-600'],
                        in_array($ext, ['ppt', 'pptx']) => ['slideshow', 'bg-bronze-50 text-bronze-500'],
                        in_array($ext, ['jpg', 'jpeg', 'png', 'webp']) => ['image', 'bg-admin-light text-admin'],
                        default => ['draft', 'bg-admin-body text-admin-text'],
                    };
                @endphp
                <div data-item class="group flex flex-col items-center gap-2 rounded-lg p-3 text-center transition-colors hover:bg-admin-body">
                    <span class="relative grid h-20 w-16 place-items-center rounded-lg {{ $tone }}">
                        <span class="material-symbols-outlined text-[34px]!" aria-hidden="true">{{ $icon }}</span>
                        <span class="absolute bottom-1.5 rounded bg-white px-1 font-mono text-[9px] font-semibold uppercase text-admin-heading">{{ $ext ?: 'file' }}</span>
                    </span>
                    <p class="line-clamp-2 text-xs font-semibold">{{ $item->judul }}</p>
                    <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100 max-md:opacity-100">
                        <a href="{{ $item->file }}" target="_blank" title="Unduh"
                            class="flex size-7 items-center justify-center rounded-lg bg-white text-admin ring-1 ring-admin-border hover:bg-admin hover:text-white">
                            <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">download</span></a>
                        <a href="{{ route('document.edit', $item->id) }}" title="Ubah"
                            class="flex size-7 items-center justify-center rounded-lg bg-white text-admin-text ring-1 ring-admin-border hover:text-admin-heading">
                            <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">edit</span></a>
                        <form action="{{ route('document.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="flex size-7 items-center justify-center rounded-lg bg-white text-admin-text ring-1 ring-admin-border hover:bg-danger-50 hover:text-danger-600">
                                <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">delete</span></button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full flex flex-col items-center gap-1 py-14 text-sm text-admin-text">
                    <span class="material-symbols-outlined text-[36px]!" aria-hidden="true">folder_off</span> Folder kosong.
                </p>
            @endforelse
        </div>
        <footer class="border-t border-admin-border bg-admin-body/60 px-5 py-2 font-mono text-[11px] text-admin-text">{{ $dokumen->count() }} item</footer>
    </div>
@endsection
