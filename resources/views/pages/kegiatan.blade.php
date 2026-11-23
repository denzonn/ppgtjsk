@extends('layouts.app')

@section('title')
    Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <section class="mt-[100px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="mb-4 mt-12 flex flex-col items-center" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="relative mb-2 inline-block pb-[5px] text-center text-[2rem] font-semibold after:absolute after:bottom-0 after:left-[40%] after:h-0.5 after:w-[60px] after:bg-[#227bff]">
                    Kegiatan PPGT JSK</h2>
            </div>

            <details data-bidang-menu class="relative z-20 w-full md:w-fit" data-aos="fade-up" data-aos-duration="1000">
                <summary
                    class="flex min-w-[260px] cursor-pointer list-none items-center justify-between gap-4 rounded bg-[#5380f7] px-5 py-4 text-xs font-semibold uppercase tracking-[1.2px] text-white shadow-[0_4px_12px_rgba(0,0,0,0.1)] [&::-webkit-details-marker]:hidden">
                    <span>Pilih Bidang</span><i class="fa-solid fa-earth-asia text-base"></i>
                </summary>
                <ul
                    class="absolute left-0 top-full mt-3 w-full rounded bg-white text-left shadow-[0_4px_12px_rgba(0,0,0,0.1)] before:absolute before:-top-1.5 before:left-5 before:size-3 before:rotate-45 before:bg-white">
                    @foreach ($bidang as $item)
                        <li class="relative px-5 text-[#666]">
                            <a href="#" data-bidang="{{ $item->nama_bidang }}"
                                class="block border-b border-black/5 py-4 text-[0.7rem] hover:text-[#5380f7]">{{ $item->nama_bidang }}</a>
                        </li>
                    @endforeach
                </ul>
            </details>

            <div class="relative mb-[250px] mt-2">
                @foreach ($bidang as $index => $bidangItem)
                    <div data-bidang-page="{{ $bidangItem->nama_bidang }}" @if ($index !== 0) hidden @endif>
                        <div class="grid gap-4 lg:grid-cols-2">
                            @php
                                $increment = 0;
                            @endphp
                            @foreach ($kegiatan[$bidangItem->id] as $item)
                                <div class="mt-3 lg:mt-0" data-aos="fade-up" data-aos-duration="{{ $increment += 1000 }}">
                                    @include('pages.partials.kegiatan-card')
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('addon-script')
    <script>
        document.querySelectorAll('[data-bidang]').forEach((link) => link.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('[data-bidang-page]').forEach((page) => page.hidden = page.dataset.bidangPage !== link.dataset.bidang);
            document.querySelector('[data-bidang-menu]').open = false;
            AOS.refresh();
        }));
    </script>
@endpush
