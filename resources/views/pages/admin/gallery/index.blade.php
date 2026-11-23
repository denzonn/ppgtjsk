@extends('layouts.admin')

@section('title')
    Galeri Kegiatan
@endsection

@section('content')
    {{-- Header: strip film --}}
    <header class="mb-8 overflow-hidden rounded-3xl bg-slate-900 text-white">
        <div class="h-4 bg-[repeating-linear-gradient(90deg,transparent_0_10px,#fff3_10px_22px)]"></div>
        <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-6 md:px-8">
            <div>
                <h1 class="text-3xl font-black"><span class="text-pink-400">●</span> Galeri Kegiatan</h1>
                <p class="text-slate-400">{{ $gallery->count() }} foto · 5 terbaru tampil di slider beranda. Klik foto untuk memperbesar.</p>
            </div>
            <a href="{{ route('gallery-kegiatan.create') }}"
                class="inline-flex items-center gap-2 rounded-full bg-pink-500 px-6 py-3 font-bold text-white shadow-lg shadow-pink-500/40 transition hover:bg-pink-400">
                <i class="bx bx-camera text-xl"></i> Tambah Foto
            </a>
        </div>
        <div class="h-4 bg-[repeating-linear-gradient(90deg,transparent_0_10px,#fff3_10px_22px)]"></div>
    </header>

    <div class="lightgallery columns-2 gap-4 md:columns-3 2xl:columns-4">
        @forelse ($gallery as $item)
            <figure class="group relative mb-4 break-inside-avoid overflow-hidden rounded-2xl bg-slate-200">
                <a href="{{ Storage::url($item->photo) }}" data-sub-html="{{ $item->kegiatan->name ?? '' }}">
                    <img src="{{ Storage::url($item->photo) }}" alt="" class="w-full transition duration-500 group-hover:scale-105">
                </a>
                <figcaption
                    class="pointer-events-none absolute inset-x-0 bottom-0 flex items-end justify-between gap-2 bg-linear-to-t from-black/80 to-transparent p-4 pt-10 text-white opacity-0 transition group-hover:opacity-100 max-md:opacity-100">
                    <span class="text-sm font-semibold">{{ $item->kegiatan->name ?? '-' }}</span>
                    <form action="{{ route('gallery-kegiatan.destroy', $item->id) }}" method="POST" class="pointer-events-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                            class="grid size-9 place-items-center rounded-full bg-white/20 backdrop-blur hover:bg-rose-500"><i class="bx bx-trash"></i></button>
                    </form>
                </figcaption>
            </figure>
        @empty
            <p class="rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada foto.</p>
        @endforelse
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('.lightgallery').lightGallery({
                selector: 'figure > a',
                download: false
            });
        });
    </script>
@endpush
