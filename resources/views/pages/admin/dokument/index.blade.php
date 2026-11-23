@extends('layouts.admin')

@section('title')
    Dokumen
@endsection

@section('content')
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
        {{-- Header: toolbar file explorer --}}
        <header class="flex flex-wrap items-center gap-4 border-b border-admin-border bg-slate-50 px-6 py-4">
            <span class="grid size-11 place-items-center rounded-xl bg-indigo-600 text-2xl text-white"><i class="bx bxs-folder-open"></i></span>
            <div class="flex-1">
                <h1 class="text-lg font-extrabold text-admin-heading">Dokumen PPGT</h1>
                <p class="text-xs text-slate-500">Bisa diunduh pengunjung di halaman "Document".</p>
            </div>
            <label class="flex items-center gap-2 rounded-xl bg-white px-3 py-2 ring-1 ring-admin-border focus-within:ring-indigo-400">
                <i class="bx bx-search text-slate-400"></i>
                <input type="search" data-filter="#files" placeholder="Cari file…" class="w-40 bg-transparent text-sm outline-none">
            </label>
            <a href="{{ route('document.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                <i class="bx bx-upload"></i> Unggah
            </a>
        </header>

        <div id="files" class="grid grid-cols-2 gap-2 p-4 sm:grid-cols-3 md:p-6 lg:grid-cols-4 2xl:grid-cols-6">
            @forelse ($dokumen as $item)
                @php
                    $ext = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
                    [$icon, $tone] = match (true) {
                        $ext === 'pdf' => ['bxs-file-pdf', 'text-rose-500 bg-rose-50'],
                        in_array($ext, ['doc', 'docx']) => ['bxs-file-doc', 'text-blue-500 bg-blue-50'],
                        in_array($ext, ['xls', 'xlsx', 'csv']) => ['bxs-spreadsheet', 'text-emerald-500 bg-emerald-50'],
                        in_array($ext, ['ppt', 'pptx']) => ['bxs-slideshow', 'text-orange-500 bg-orange-50'],
                        in_array($ext, ['jpg', 'jpeg', 'png', 'webp']) => ['bxs-file-image', 'text-fuchsia-500 bg-fuchsia-50'],
                        default => ['bxs-file', 'text-slate-500 bg-slate-100'],
                    };
                @endphp
                <div data-item class="group relative flex flex-col items-center rounded-2xl p-4 text-center transition hover:bg-indigo-50/60">
                    <span class="relative grid h-24 w-20 place-items-center rounded-xl text-5xl {{ $tone }}">
                        <i class="bx {{ $icon }}"></i>
                        <span class="absolute bottom-2 rounded bg-white px-1.5 text-[0.6rem] font-black uppercase text-slate-600 shadow-sm">{{ $ext ?: 'file' }}</span>
                    </span>
                    <p class="mt-3 line-clamp-2 text-sm font-semibold text-admin-heading">{{ $item->judul }}</p>
                    <div class="mt-2 flex gap-1 opacity-0 transition group-hover:opacity-100 max-md:opacity-100">
                        <a href="{{ Storage::url($item->file) }}" target="_blank" title="Unduh"
                            class="grid size-8 place-items-center rounded-lg bg-white text-indigo-600 shadow-sm hover:bg-indigo-600 hover:text-white"><i class="bx bx-download"></i></a>
                        <a href="{{ route('document.edit', $item->id) }}" title="Ubah"
                            class="grid size-8 place-items-center rounded-lg bg-white text-slate-600 shadow-sm hover:bg-slate-700 hover:text-white"><i class="bx bx-edit-alt"></i></a>
                        <form action="{{ route('document.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="grid size-8 place-items-center rounded-lg bg-white text-rose-600 shadow-sm hover:bg-rose-600 hover:text-white"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full py-16 text-center text-slate-400"><i class="bx bx-folder-open block text-5xl"></i> Folder kosong.</p>
            @endforelse
        </div>
        <footer class="border-t border-admin-border bg-slate-50 px-6 py-2 text-xs text-slate-500">{{ $dokumen->count() }} item</footer>
    </div>
@endsection
