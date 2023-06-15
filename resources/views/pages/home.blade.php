@extends('layouts.app2')

@section('title')
    PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <!-- Activity Information -->
    <section class="activity-info">
        <div class="parallax">
            <div class="container">
                <div class="text-page">
                    <h1 data-aos="fade-up" data-aos-duration="1500">
                        <span id="home"></span>
                    </h1>
                    <div class="text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="500">
                        1 Korintus 3:11 (TB) Karena tidak ada seorang pun yang dapat meletakkan dasar lain dari pada dasar
                        yang telah diletakkan, yaitu Yesus Kristus.
                    </div>
                    <a href="#kegiatan" class="activities btn mt-2" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-delay="500">
                        INFO KEGIATAN
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Activity Information -->

    <!-- Renungan -->
    <section class="renungan">
        <div class="container">
            <div class="content mt-5 mb-3">
                <h2>Renungan Pagi</h2>
            </div>
            <div class="text text-justify">
                @foreach ($renungan as $item)
                    <div class="video-container">
                        <iframe height="300" src="{{ $item->url_youtube }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="description">
                        <h4 class="sub">{{ $item->judul }} ({{ $item->ayat }})</h4>
                        <p>
                            {!! $item->isi !!}
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="creator">
                <hr>
                <div class="text">
                    Penulis : Tim Renungan Harian GT
                </div>
                <hr>
            </div>
        </div>
    </section>
    <!-- Renungan -->

    <!-- All Acitivity -->
    <section class="activity mb-5" id="kegiatan">
        <div class="container">
            <div class="content ">
                <h2>Kegiatan PPGT</h2>
            </div>
            <div class="row">
                @foreach ($kegiatan as $item)
                    <div class="col-12 col-md-6 col-lg-4 mt-2">
                        <div class="card">
                            <img src="{{ Storage::url($item->photo) }}" alt="">
                            <div class="description">
                                <h3>{{ $item->name }}</h3>
                                <p>{!! $item->description !!}</p>
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- All Acitivity -->

    <!-- Gallery -->
    <section class="gallery">
        <div class="container">
            <div class="content mb-3">
                <h2>Dokumentasi Kegiatan</h2>
            </div>
            <p class="text-muted text-center">
                "Jangan lewatkan momen spesial kami! Lihat galeri foto kegiatan kami
                dan saksikan betapa serunya kami dalam melakukan berbagai aktivitas
                yang pasti akan membuat Anda terinspirasi." <a href="{{ route('gallery') }}"
                    style="text-decoration: none">Liat Semua......</a>
            </p>
        </div>
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($gallery as $item)
                    <div class="swiper-slide">
                        <!-- elements with  "swiper-carousel-animate-opacity" class will have animated opacity -->
                        <div class="swiper-carousel-animate-opacity">
                            <img src="{{ Storage::url($item->photo) }}" alt="">
                            <div class="slide-content" style="color: #fff">
                                <h2>{{ $item->kegiatan->name }}</h2>
                                <p>{!! $item->kegiatan->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Gallery -->

    <!-- Pengurus -->
    <div class="administrator">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="title text-center mb-4">
                        <h2>K S W B
                            <br>
                            2022 - 2024
                            <br>
                            <span>Ketua - Sekretaris - Wakil Sekretaris - Bendahara</span>
                        </h2>
                    </div>
                    <div class="details">
                        <div class="row">
                            @foreach ($ksb as $index => $item)
                                <div
                                    class="col-6 col-md-6 col-lg-4 mb-3 {{ $index === $ksb->count() - 1 ? ' offset-lg-4' : '' }}">
                                    <div class="pic" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                        data-tilt-perspective="700">
                                        <img src="{{ Storage::url($item->foto) }}" alt="">
                                    </div>
                                    <div class="desc">
                                        <div class="name">{{ $item->nama }}</div>
                                        <div class="position">{{ $item->jabatan }}</div>
                                        <div class="motto">"{{ $item->motto }}"</div>
                                        <div class="socialmedia">
                                            <a href="{{ $item->instagram }}"><i class="fa-brands fa-instagram"></i></a>
                                            <a href="{{ $item->whatsapp }}"><i class="fa-brands fa-whatsapp"></i></a>
                                            <a href="{{ $item->facebook }}"><i class="fa-brands fa-facebook"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr class="mt-5">
                    <div class="title text-center mt-5 mb-4">
                        <h2>Pengurus PPGT
                            <br>
                            <span>Jemaat Satria Kasih</span>
                        </h2>
                    </div>
                    <div class="details">
                        <div class="row">
                            @foreach ($manajement as $item)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="image" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                        data-tilt-perspective="700">
                                        <img src="{{ Storage::url($item->foto_bidang) }}" alt="">
                                    </div>
                                    <div class="description">
                                        <div class="sector">{{ $item->nama_bidang }}</div>
                                        @foreach ($manajementPengurus as $item)
                                            @foreach ($item as $item)
                                                <div class="name">{{ $item->jabatan->nama_jabatan }} :
                                                    {{ $item->nama_anggota }}</div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($bidang as $item)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="image" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                        data-tilt-perspective="700">
                                        <img src="{{ Storage::url($item->foto_bidang) }}" alt="">
                                    </div>
                                    <div class="description">
                                        <div class="sector">{{ $item->nama_bidang }}</div>
                                        @foreach ($pengurus[$loop->index] as $anggota)
                                            @if ($anggota->jabatan->nama_jabatan == 'Koordinator')
                                                <div class="name">Koordinator: {{ $anggota->nama_anggota }}</div>
                                            @elseif ($anggota->jabatan->nama_jabatan == 'Koordinator Kelompok')
                                                <div class="name">Koordinator Kelompok: {{ $anggota->nama_anggota }}
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="name">Anggota:</div>
                                        <ol>
                                            @foreach ($pengurus[$loop->index] as $anggota)
                                                @if ($anggota->jabatan->nama_jabatan == 'Koordinator')
                                                @elseif ($anggota->jabatan->nama_jabatan == 'Koordinator Kelompok')

                                                @elseif ($anggota->jabatan->nama_jabatan == 'Wakil Koordinator')
                                                    <li>
                                                        <div class="name">{{ $anggota->nama_anggota }}</div>
                                                    </li>
                                                @else
                                                    <li>
                                                        <div class="name">{{ $anggota->nama_anggota }}</div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pengurus -->

    <!-- Contact -->
    <div class="contact">
        <div class="container">
            <hr>
            <div class="content">
                <div class="content mb-3">
                    <h2>Kontak</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Info Selanjutnya</h6>
                            <p>Untuk info lebih lanjut silahkan teman-teman menghubungi pengurus PPGT Jemaat Satria Kasih
                                atau bisa
                                melalui instagram PPGT Jemaat Satria Kasih <a
                                    href="https://www.instagram.com/ppgtsatriakasih/">@ppgtsatriakasih</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body mt-4 mt-md-0 mt-lg-0">
                            <h6>Sekilas Anggota</h6>
                            <p>Buat teman-teman yang rindu untuk mendapatkan layanan kasih (ibadah PPGT) dapat menghubungi
                                pengurus
                                Kelompok 1 <a href="https://wa.me/6282195679171">Dave</a> dan Kelompok 2 <a
                                    href="https://wa.me/6289686772915">Euro Angelo</a></p>
                            <h6 class="mt-lg-5">Pundi Kasih</h6>
                            <p>
                                Buat teman-teman yang ingin berbagi kasih dapat mengirimkan ke rekening PPGT Jemaat Satria
                                Kasih
                                <br>
                                <img src="{{ asset('images/bca.png') }}" alt=""> 548-513132-6
                                <br>
                                a/n Irene Aprianti Baan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact -->

    <!-- Suggestion -->
    <section class="suggestion">
        <div class="container">
            <div class="content mt-5 mb-3">
                <h2>Saran</h2>
            </div>
            <p class="text-muted">
                Berikan saran anda untuk membuat website ini lebih baik lagi!
            </p>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <form action="{{ route('user.saran') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label style="font-family: 'Poppins', sans-serif">Nama</label>
                            <input type="text" name="nama" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="mt-3">Saran</label>
                            <textarea name="saran"></textarea>
                        </div>
                        <button class="btn btn-primary w-100 mt-3">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Suggestion -->
@endsection

@push('addon-script')
    <script>
        $('#owl-carousel1').owlCarousel({
            loop: true,
            margin: 10,
            dots: false,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                1000: {
                    items: 1,
                },
            },
        })
        $('#owl-carousel2').owlCarousel({
            loop: true,
            margin: 15,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            nav: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 4,
                },
            },
        })
    </script>
    {{-- tYPED --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.16/typed.umd.js"
        integrity="sha512-+2pW8xXU/rNr7VS+H62aqapfRpqFwnSQh9ap6THjsm41AxgA0MhFRtfrABS+Lx2KHJn82UOrnBKhjZOXpom2LQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var typed = new Typed('#home', {
            strings: ['PENGURUS PPGT 2022 - 2024'],
            typeSpeed: 130,
            typeDelay: 100,
            loop: false,
            startDelay: 300,
        });
    </script>
@endpush
