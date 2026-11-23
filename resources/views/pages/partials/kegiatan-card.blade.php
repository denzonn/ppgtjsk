{{-- Kartu kegiatan (beranda & halaman kegiatan). Butuh $item (Kegiatan). --}}
<article
    class="m-2.5 flex flex-col rounded-lg bg-[#f2f2f2] p-4 shadow-[0_1.4rem_8rem_rgba(0,0,0,0.2)] md:min-h-52 md:flex-row md:items-center md:p-0">
    <div class="relative -translate-y-[20%] rounded-lg bg-[#efefef] md:-translate-x-[10%] md:translate-y-0">
        <img src="{{ $item->photo }}" alt="" class="block h-52 w-full rounded-lg object-cover md:size-40" />
    </div>
    <div class="pr-2.5">
        <span class="mt-1 block text-base font-semibold text-[#8e8c8c]">{{ $item->program->name }}</span>
        <h2 class="mb-2 text-2xl uppercase text-[#4facfe]">{{ $item->name }}</h2>
        <p class="mb-2 text-base font-light text-black/70">
            @if (strlen($item->description) > 100)
                {!! substr($item->description, 0, 100) !!}....
            @else
                {!! $item->description !!}
            @endif
        </p>
        <div>
            <a href="{{ route('kegiatan-detail', $item->slug) }}"
                class="mb-2 inline-block rounded-lg bg-linear-to-r from-[#4facfe] to-[#0a53be] px-3 py-2 text-[0.7rem] uppercase tracking-[1px] text-white transition-all duration-300 hover:translate-x-2.5">Read
                More</a>
        </div>
    </div>
</article>
