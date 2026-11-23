@extends('layouts.app')

@section('title')
    Detail Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@push('prepend-style')
    <link rel="modulepreload" href="{{ asset('panorama-slider.uiinitiative.com/assets/vendor.0970188b.js') }}">
    <link rel="stylesheet" href="{{ asset('panorama-slider.uiinitiative.com/assets/index.98183fc7.css') }}">
@endpush

@section('content')
    <!-- Detail Kegiatan -->
    <section class="mt-[100px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="mb-4 mt-12 flex flex-col items-center" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="relative mb-2 inline-block pb-[5px] text-center text-[2rem] font-semibold after:absolute after:bottom-0 after:left-[40%] after:h-0.5 after:w-[60px] after:bg-[#227bff]">
                    {{ $kegiatan->name }}</h2>
            </div>
            <div class="relative mb-[250px] flow-root" data-aos="fade-up" data-aos-duration="2000">
                <img src="{{ $kegiatan->photo }}" alt=""
                    class="mb-2.5 h-[250px] w-full rounded-[5px] object-cover md:float-left md:mr-5 md:w-auto">
                <div class="text-xl font-semibold" data-aos="fade-up" data-aos-duration="1500">Deskripsi Kegiatan : </div>
                <div class="overflow-hidden text-[0.9rem] font-light md:text-base" data-aos="fade-up" data-aos-duration="2000">
                    <div class="rich-text">{!! $kegiatan->description !!}</div>
                    @if (!is_null($linkDrive))
                        (
                        @forelse ($linkDrive as $index => $item)
                            <a class="text-sm text-black no-underline" target="_blank" href="{{ $item }}">
                                Drive {{ $index + 1 }}
                                @if (!$loop->last)
                                    -
                                @endif
                            </a>
                        @empty
                            Tidak ada link Drive.
                        @endforelse
                        )
                    @else
                        (Tidak ada link Drive.)
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-[#fdfdfd]">
            <h4 class="relative flex items-center justify-center pt-5 text-2xl font-semibold after:absolute after:-bottom-5 after:h-0.5 after:w-[60px] after:bg-[#227bff]"
                data-aos="fade-up" data-aos-duration="1000">Gallery Kegiatan</h4>
            <div id="app">
                <!-- Panorama slider -->
                <div class="panorama-slider" data-aos="zoom-out" data-aos-duration="2000">
                    <div class="swiper">
                        <div class="swiper-pagination"></div>
                        <div class="swiper-wrapper">
                            @foreach ($gallery as $item)
                                <div class="swiper-slide">
                                    <img class="slide-image" src="{{ $item->photo }}" alt="">
                                </div>
                            @endforeach
                            <div class="swiper-slide">
                                <img class="slide-image" src="{{ $kegiatan->photo }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Detail Kegiatan -->
@endsection

@push('prepend-script')
    <script type="module" crossorigin src="{{ asset('panorama-slider.uiinitiative.com/assets/index.3cc42008.js') }}">
    </script>
@endpush
