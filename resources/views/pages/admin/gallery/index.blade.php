@extends('layouts.admin')

@section('title')
    Galeri Kegiatan
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul: strip film --}}
        <header class="overflow-hidden rounded-xl bg-admin-ink text-white">
            <div class="h-3 bg-[repeating-linear-gradient(90deg,transparent_0_10px,#ffffff26_10px_20px)]"></div>
            <div class="flex flex-col justify-between gap-3 px-5 py-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="flex items-center gap-2 text-xl font-bold tracking-tight"><span class="size-2 rounded-full bg-bronze-400"></span> Galeri Kegiatan</h1>
                    <p class="text-sm text-ink-200"><span class="font-mono">{{ $gallery->count() }}</span> foto · 5 terbaru tampil di slider beranda. Klik foto untuk memperbesar.</p>
                </div>
                <a href="{{ route('gallery-kegiatan.create') }}"
                    class="inline-flex items-center gap-1.5 self-start rounded-lg bg-white px-3.5 py-2 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-light sm:self-auto">
                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">add_photo_alternate</span> Tambah Foto
                </a>
            </div>
            <div class="h-3 bg-[repeating-linear-gradient(90deg,transparent_0_10px,#ffffff26_10px_20px)]"></div>
        </header>

        <div class="lightgallery columns-2 gap-3 md:columns-3 xl:columns-4">
            @forelse ($gallery as $item)
                <figure class="group relative mb-3 break-inside-avoid overflow-hidden rounded-xl bg-admin-body">
                    <a href="{{ $item->photo }}" data-sub-html="{{ $item->kegiatan->name ?? '' }}">
                        <img src="{{ $item->photo }}" alt="" loading="lazy" onerror="this.outerHTML='<span class=&quot;grid aspect-[4/3] place-items-center bg-admin-light text-ink-300&quot;><span class=&quot;material-symbols-outlined text-[36px]!&quot;>image</span></span>'" class="w-full transition-transform duration-500 group-hover:scale-105">
                    </a>
                    <figcaption
                        class="pointer-events-none absolute inset-x-0 bottom-0 flex items-end justify-between gap-2 bg-linear-to-t from-black/75 to-transparent p-3 pt-10 text-white opacity-0 transition-opacity group-hover:opacity-100 max-md:opacity-100">
                        <span class="text-xs font-semibold">{{ $item->kegiatan->name ?? '-' }}</span>
                        <form action="{{ route('gallery-kegiatan.destroy', $item->id) }}" method="POST" class="pointer-events-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="grid size-8 place-items-center rounded-lg bg-white/15 backdrop-blur transition-colors hover:bg-danger-500">
                                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">delete</span></button>
                        </form>
                    </figcaption>
                </figure>
            @empty
                <p class="rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada foto.</p>
            @endforelse
        </div>
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
