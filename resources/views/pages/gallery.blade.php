@extends('layouts.app')

@section('title')
    Gallery Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('lightbox/dist/css/lightbox.min.css') }}">
@endpush

@section('content')
    <section class="relative z-[2] mt-[100px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="mb-4 mt-12 flex flex-col items-center" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="mb-2 inline-block border-b-4 border-brand pb-[5px] text-center font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                    Dokumentasi Kegiatan</h2>
                <p class="mb-4 text-center text-gray-500">
                    "Jangan lewatkan momen spesial kami! Lihat galeri foto kegiatan kami
                    dan saksikan betapa serunya kami dalam melakukan berbagai aktivitas
                    yang pasti akan membuat Anda terinspirasi."
                </p>
            </div>

            <details data-kegiatan-menu class="relative z-20 w-full md:w-fit" data-aos="fade-up" data-aos-duration="2000">
                <summary
                    class="flex min-w-[260px] cursor-pointer list-none items-center justify-between gap-4 rounded bg-[#5380f7] px-5 py-4 text-xs font-semibold uppercase tracking-[1.2px] text-white shadow-[0_4px_12px_rgba(0,0,0,0.1)] [&::-webkit-details-marker]:hidden">
                    <span>Pilih Kegiatan</span><i class="fa-solid fa-earth-asia text-base"></i>
                </summary>
                <ul
                    class="absolute left-0 top-full mt-3 max-h-80 w-full overflow-y-auto rounded bg-white text-left shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                    @foreach ($kegiatan as $item)
                        <li class="px-5 text-[#666]">
                            <a href="#" data-kegiatan="{{ $item->id }}"
                                class="block border-b border-black/5 py-4 text-[0.7rem] hover:text-[#5380f7]">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </details>

            @foreach ($kegiatan as $index => $kegiatanItem)
                <div data-kegiatan-page="{{ $kegiatanItem->id }}" @if ($index !== 0) hidden @endif>
                    <h3 class="mb-2 mt-6 text-center text-base font-light md:text-2xl" data-aos="fade-up"
                        data-aos-duration="1000">{{ $kegiatanItem->name }}</h3>
                    <div class="grid gap-4 md:grid-cols-3 lg:grid-cols-4">
                        @php
                            $incrementProduct = 0;
                            $photos = $gallery[$kegiatanItem->id]->pluck('photo')->push($kegiatanItem->photo);
                        @endphp
                        @foreach ($photos as $photo)
                            <a href="{{ $photo }}" data-lightbox="kegiatan-{{ $kegiatanItem->id }}"
                                data-title="{{ $kegiatanItem->name }}" data-aos="fade-up"
                                data-aos-delay="{{ $incrementProduct += 100 }}">
                                <img src="{{ $photo }}" alt="{{ $kegiatanItem->name }}"
                                    class="h-[300px] w-full cursor-pointer rounded-[5px] object-cover shadow-[0.3rem_0.4rem_0.4rem_rgba(0,0,0,0.1)] transition-all duration-300 hover:scale-[1.03]" />
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('addon-script')
    <script src="{{ asset('lightbox/dist/js/lightbox.min.js') }}"></script>
    <script>
        lightbox.option({
            maxWidth: 800,
            maxHeight: 600,
        });

        document.querySelectorAll('[data-kegiatan]').forEach((link) => link.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('[data-kegiatan-page]').forEach((page) => page.hidden = page.dataset.kegiatanPage !== link.dataset.kegiatan);
            document.querySelector('[data-kegiatan-menu]').open = false;
            AOS.refresh();
        }));
    </script>
@endpush
