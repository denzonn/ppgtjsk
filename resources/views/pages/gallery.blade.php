@extends('layouts.app')

@section('title')
    Gallery Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <!-- Gallery -->
    <section class="gallery">
        <div class="container">
            <div class="content mt-5 mb-3">
                <h2>Dokumentasi Kegiatan</h2>
                <p class="text-muted text-center">
                    "Jangan lewatkan momen spesial kami! Lihat galeri foto kegiatan kami
                    dan saksikan betapa serunya kami dalam melakukan berbagai aktivitas
                    yang pasti akan membuat Anda terinspirasi."
                </p>
            </div>
            <div class="dropdownFill">
                <a class="btn-primary">Pilih Kegiatan</a>
                <div class="dropdownFill-content">
                    <a href="#" onclick="showPage('badminton')">Badminton</a>
                    <a href="#" onclick="showPage('ibadah')">Ibadah</a>
                </div>
            </div>

            <div class="gallery-photo">
                <div class="row">
                    <div id="badminton" class="page active ">
                        <div class="row">
                            <div class="description mt-4">
                                <h4>Deskripsi Kegiatan</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, fugiat! Dolorum et
                                    corrupti
                                    laborum
                                    doloribus harum, nemo eum dolore accusamus veritatis natus maxime, suscipit ex! Quas
                                    cupiditate in
                                    nesciunt
                                    ducimus?</p>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <div class="card">
                                    <a href="/assets/images/badminton.jpg" data-lightbox="roadtrip" data-title="Badminton"
                                        class="card-image">
                                        <img src="/assets/images/badminton.jpg" alt="Gambar Card" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <div class="card">
                                    <a href="/assets/images/pengurus.jpg" data-lightbox="roadtrip" data-title="Badminton"
                                        class="card-image">
                                        <img src="/assets/images/pengurus.jpg" alt="Gambar Card" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <div class="card">
                                    <a href="/assets/images/badminton.jpg" data-lightbox="roadtrip" data-title="Badminton"
                                        class="card-image">
                                        <img src="/assets/images/badminton.jpg" alt="Gambar Card" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <div class="card">
                                    <a href="/assets/images/pengurus.jpg" data-lightbox="roadtrip" data-title="Badminton"
                                        class="card-image">
                                        <img src="/assets/images/pengurus.jpg" alt="Gambar Card" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ibadah" class="page ">
                        <div class="row">
                            <div class="description mt-4">
                                <h4>Deskripsi Kegiatan</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, fugiat! Dolorum et
                                    corrupti
                                    laborum
                                    doloribus harum, nemo eum dolore accusamus veritatis natus maxime, suscipit ex! Quas
                                    cupiditate in
                                    nesciunt
                                    ducimus?</p>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <div class="card">
                                    <a href="/assets/images/logo.png" data-lightbox="roadtrip" data-title="Badminton"
                                        class="card-image">
                                        <img src="/assets/images/logo.png" alt="Gambar Card" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <div class="card">
                                    <a href="/assets/images/pengurus.jpg" data-lightbox="roadtrip" data-title="Badminton"
                                        class="card-image">
                                        <img src="/assets/images/pengurus.jpg" alt="Gambar Card" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <div class="card">
                                    <a href="/assets/images/badminton.jpg" data-lightbox="roadtrip" data-title="Badminton"
                                        class="card-image">
                                        <img src="/assets/images/badminton.jpg" alt="Gambar Card" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mt-2">
                                <div class="card">
                                    <a href="/assets/images/pengurus.jpg" data-lightbox="roadtrip" data-title="Badminton"
                                        class="card-image">
                                        <img src="/assets/images/pengurus.jpg" alt="Gambar Card" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

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

    <!-- Filter -->
    <script>
        // Membuat dropdown bisa ditutup saat klik di luar dropdown
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName('dropdown-content')
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i]
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none'
                    }
                }
            }
        }
    </script>
    <!-- Filter -->

    <script>
        lightbox.option({
            'maxWidth': 800,
            'maxHeight': 600,
        })
    </script>
@endpush
