@extends('layouts.app')

@section('title')
    Gallery Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endpush

@section('content')
    <!-- Gallery -->
    <section class="gallery">
        <div class="container">
            <div class="content mt-5 mb-3" data-aos="fade-up" data-aos-duration="1000">
                <h2>Dokumentasi Kegiatan</h2>
                <p class="text-muted text-center">
                    "Jangan lewatkan momen spesial kami! Lihat galeri foto kegiatan kami
                    dan saksikan betapa serunya kami dalam melakukan berbagai aktivitas
                    yang pasti akan membuat Anda terinspirasi."
                </p>
            </div>

            <div class="fill" data-aos="fade-up" data-aos-duration="2000">
                <button class="btn" onclick="toggleDropdown()"><span>Pilih Kegiatan</span><i
                        class="material-icons">public</i>
                    <ul class="dropdown drops" style="z-index: 99">
                        @foreach ($kegiatan as $item)
                            <li>
                                <a href="#" onclick="showPage('{{ $item->name }}')">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </button>
            </div>

            <div class="gallery-photo" id="galleryPhoto" style="z-index: 1">
                <div class="row">
                    @foreach ($kegiatan as $index => $kegiatanItem)
                        <div id="{{ $kegiatanItem->name }}" class="page {{ $index === 0 ? 'active' : '' }}">
                            <div class="row">
                                <div class="description mt-4" data-aos="fade-up" data-aos-duration="1000">
                                    <h3 class="text-center">{{ $kegiatanItem->name }}</h2>
                                </div>
                                @php
                                    $incrementProduct = 0;
                                @endphp
                                @foreach ($gallery[$kegiatanItem->id] as $index => $galleryItem)
                                    <div class="col-12 col-md-4 col-lg-3 mt-2" data-aos="fade-up"
                                        data-aos-delay="{{ $incrementProduct += 100 }}">
                                        <div class="card">
                                            <a href="{{ Storage::url($galleryItem->photo) }}" data-lightbox="roadtrip"
                                                data-title="{{ $galleryItem->kegiatan->name }}" class="card-image">
                                                <img src="{{ Storage::url($galleryItem->photo) }}" alt="Gambar Card" />
                                            </a>
                                        </div>
                                    </div>
                                    @if ($index === count($gallery[$kegiatanItem->id]) - 1)
                                        @php
                                            $lastIncrementProduct = $incrementProduct;
                                        @endphp
                                    @endif
                                @endforeach
                                <div class="col-12 col-md-4 col-lg-3 mt-2" data-aos="fade-up"
                                    data-aos-delay="{{ $lastIncrementProduct += 100 }}">
                                    <div class="card">
                                        <a href="{{ Storage::url($kegiatanItem->photo) }}" data-lightbox="roadtrip"
                                            class="card-image">
                                            <img src="{{ Storage::url($kegiatanItem->photo) }}" alt="Gambar Card" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery -->
@endsection


@push('addon-script')
    <!-- Pages -->

    <script>
        // Function untuk menampilkan halaman yang dipilih
        function showPage(pageId) {
            // Menghapus class "active" dari semua halaman
            var pages = document.getElementsByClassName('page');
            for (var i = 0; i < pages.length; i++) {
                pages[i].classList.remove('active');
            }
            // Menambahkan class "active" ke halaman yang dipilih
            var page = document.getElementById(pageId);
            page.classList.add('active');

            AOS.init();
        }

        // Function untuk mengatur z-index gallery-photo
        function toggleDropdown() {
            var dropdown = document.querySelector('.dropdown');
            var galleryPhoto = document.getElementById('galleryPhoto');

            if (dropdown.style.display === 'none') {
                // Ketika dropdown tampil
                dropdown.style.display = 'block';
                galleryPhoto.style.zIndex = '-1';
            } else {
                // Ketika dropdown disembunyikan
                dropdown.style.display = 'none';
                galleryPhoto.style.zIndex = '1';
            }
        }

        // Event listener untuk menutup dropdown dan mengembalikan z-index gallery-photo saat mousedown di luar dropdown
        document.addEventListener('mousedown', function(event) {
            var dropdown = document.querySelector('.dropdown');
            var galleryPhoto = document.getElementById('galleryPhoto');
            var targetElement = event.target;

            // Jika yang diklik bukan bagian dropdown atau button dropdown, maka sembunyikan dropdown dan kembalikan z-index gallery-photo
            if (!dropdown.contains(targetElement) && !targetElement.classList.contains('btn')) {
                dropdown.style.display = 'none';
                galleryPhoto.style.zIndex = '1';
            }
        });
    </script>
    <!-- Pages -->

    <!-- Filter -->

    <script>
        lightbox.option({
            'maxWidth': 800,
            'maxHeight': 600,
        })
    </script>
@endpush
