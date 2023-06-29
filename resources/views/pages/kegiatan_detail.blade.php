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
    <section class="kegiatan">
        <div class="container">
            <div class="content mt-5 mb-3" data-aos="fade-up" data-aos-duration="1000">
                <h2>{{ $kegiatan->name }}</h2>
            </div>
            <div class="kegiatan-photo" data-aos="fade-up" data-aos-duration="2000">
                <div class="image">
                    <img src="{{ Storage::url($kegiatan->photo) }}" class="w-100"
                        style="height: 250px; object-fit: cover; border-radius: 5px">
                </div>
                <div class="description">
                    <div style="font-family: 'Poppins', sans-serif; font-size: 1.3rem; font-weight: 600" data-aos="fade-up"
                        data-aos-duration="1500">Deskripsi
                        Kegiatan : </div>
                    <p data-aos="fade-up" data-aos-duration="2000">
                        {!! $kegiatan->description !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="gallery">
            <h4 data-aos="fade-up" data-aos-duration="1000">Gallery Kegiatan</h4>
            <div id="app">
                <!-- Panorama slider -->
                <div class="panorama-slider" data-aos="zoom-out" data-aos-duration="2000">
                    <div class="swiper">
                        <div class="swiper-pagination"></div>
                        <div class="swiper-wrapper">
                            @foreach ($gallery as $item)
                                <div class="swiper-slide">
                                    <img class="slide-image" src="{{ Storage::url($item->photo) }}" alt="">
                                </div>
                            @endforeach
                            <div class="swiper-slide">
                                <img class="slide-image" src="{{ Storage::url($kegiatan->photo) }}" alt="">
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
    <script type="module" crossorigin src="{{ asset('panorama-slider.uiinitiative.com/assets/index.3cc42008.js') }}"></script>
@endpush


@push('addon-script')
    <!-- Pages -->
    <script>
        // Function untuk menampilkan halaman yang dipilih
        function showPage(pageId) {
            // Menghapus class "active" dari semua halaman
            var pages = document.getElementsByClassName('page')
            for (var i = 0; i < pages.length; i++) {
                pages[i].classList.remove('active')
            }
            // Menambahkan class "active" ke halaman yang dipilih
            var page = document.getElementById(pageId)
            page.classList.add('active')
        }
    </script>
    <!-- Pages -->

    <script>
        lightbox.option({
            'maxWidth': 800,
            'maxHeight': 600,
        })
    </script>
@endpush
