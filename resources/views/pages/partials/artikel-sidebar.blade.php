{{-- Sidebar artikel (Popular Posts + Tags), dipakai di halaman daftar & detail artikel --}}
<div>
    <div class="mt-[60px] text-2xl font-semibold text-[#393E46] md:mt-0 md:text-[28px]">Popular Posts</div>
    <div class="mt-2">
        @foreach ($popularArtikel as $item)
            <div class="mb-1">
                <a href="{{ route('artikel-detail', $item->slug) }}"
                    class="text-sm font-medium text-[#393E46] transition-all hover:text-ppgt-700 md:text-lg">
                    {{ $item->judul }}
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-11 text-2xl font-semibold text-[#393E46] md:text-[28px]">Tags</div>
    <div class="mt-2 flex flex-wrap gap-1">
        @foreach ($randomTags as $item)
            <span class="mb-2 rounded bg-ppgt-700 px-2 py-1 text-sm font-bold text-white">{{ $item }}</span>
        @endforeach
    </div>
</div>
