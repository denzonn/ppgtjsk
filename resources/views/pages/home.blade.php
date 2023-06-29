@extends('layouts.app2')

@section('title')
    PPGT Jemaat Satria Kasih
@endsection

@push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
@endpush

@push('prepend-style')
    <script type="module" crossorigin src="{{ asset('carousel/assets/index.ef4fdc7a.js') }}"></script>
    <link rel="modulepreload" href="{{ asset('carousel/assets/vendor.8992d2a8.js') }}">
    <link rel="stylesheet" href="{{ asset('carousel/assets/index.3e4e39bd.css') }}">
@endpush

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
            <div class="content mt-5 mb-3" data-aos="fade-up" data-aos-duration="1000">
                <h2>Renungan Pagi</h2>
            </div>
            <div class="text text-justify" data-aos="fade-up" data-aos-duration="2000">
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
            <div class="creator" data-aos="fade-up" data-aos-duration="2500">
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
        <div class="shape" data-aos="fade-up" data-aos-duration="1000"></div>
        <div class="container">
            <div class="content " data-aos="fade-up" data-aos-duration="1000">
                <h2>Kegiatan PPGT</h2>
            </div>
            <div class="row">
                @php
                    $increment = 0;
                @endphp
                @foreach ($kegiatan as $item)
                    <div class="col-12 col-lg-6 mt-3 mt-lg-0" data-aos="fade-up"
                        data-aos-duration="{{ $increment += 1000 }}">
                        <article class="blog-post p-4 p-lg-0">
                            <div class="blog-post__img">
                                <img src="{{ Storage::url($item->photo) }}" alt="" />
                            </div>
                            <div class="blog-post__info">
                                <div class="blog-post__date">
                                    <span>{{ $item->program->name }}</span>
                                </div>
                                <h2 class="blog-post__title">{{ $item->name }}</h2>
                                @if (strlen($item->description) > 100)
                                    <p>{!! substr($item->description, 0, 100) !!}....</p>
                                @else
                                    <p>{!! $item->description !!}</p>
                                @endif

                                <div><a href="{{ route('kegiatan-detail', $item->slug) }}" class="blog-post__cta">Read
                                        More</a></div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- All Acitivity -->

    {{-- Activity Weekend --}}
    <section class="activityWeekend">
        <div class="container">
            <div class="content" data-aos="fade-up" data-aos-duration="1000">
                <h2>Kegiatan Seminggu</h2>
            </div>
            <div class="card mt-4" style="border: none">
                <div class="card-body">
                    {{-- Datatable --}}
                    <div class="table-responsive" data-aos="fade-up" data-aos-duration="2000">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Hari/Tanggal</th>
                                    <th style="width: 30%">Kegiatan</th>
                                    <th style="width: 20%">Waktu</th>
                                    <th style="width: 30%">Tempat</th>
                                </tr>
                            </thead>
                            @php
                                $increment2 = 1000;
                            @endphp
                            <tbody>
                                @forelse ($kegiatanMingguan as $item)
                                    <tr data-aos="fade-up" data-aos-duration="{{ $increment2 += 500 }}">
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                        </td>
                                        <td>{{ $item->kegiatan->name }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{!! $item->tempat !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada kegiatan minggu ini</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Activity Weekend --}}

    <!-- Gallery -->
    <section class="gallery">
        <div class="container">
            <div class="content mb-3" data-aos="fade-up" data-aos-duration="1000">
                <h2>Dokumentasi Kegiatan</h2>
            </div>
            <p class="text-muted text-center" data-aos="fade-up" data-aos-duration="2000">
                "Jangan lewatkan momen spesial kami! Lihat galeri foto kegiatan kami
                dan saksikan betapa serunya kami dalam melakukan berbagai aktivitas
                yang pasti akan membuat Anda terinspirasi." <a href="{{ route('gallery') }}"
                    style="text-decoration: none">Liat Semua......</a>
            </p>
        </div>
        <div class="swiper" data-aos="zoom-in" data-aos-duration="2000">
            <div class="swiper-wrapper">
                @foreach ($gallery as $item)
                    <div class="swiper-slide">
                        <!-- elements with  "swiper-carousel-animate-opacity" class will have animated opacity -->
                        <div class="swiper-carousel-animate-opacity">
                            <img src="{{ Storage::url($item->photo) }}" alt="">
                            <div class="slide-content" style="color: #fff">
                                <h2>{{ $item->kegiatan->name }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Gallery -->

    <!-- Pengurus -->
    <div class="administrator mt-3">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="title text-center mb-4" data-aos="fade-up" data-aos-duration="2000">
                        <h2 class="kswb">K S W B
                            <br>
                            2022 - 2024
                            <br>
                            <span>Ketua - Sekretaris - Wakil Sekretaris - Bendahara</span>
                        </h2>
                    </div>
                    <section class="kswb container" data-aos="fade-up" data-aos-duration="1000">
                        <div class="gallery-wrapper">
                            @foreach ($ksb as $key => $item)
                                <figure class="gallery-item{{ $key === 0 ? ' large' : '' }}">
                                    <img src="{{ Storage::url($item->foto) }}" alt="" class="item-image" />
                                    <figcaption class="item-description">
                                        <h2 class="name">{{ $item->nama }}</h2>
                                        <br>
                                        <div class="role">{{ $item->jabatan }}</div>
                                        <br>
                                        <div class="motto">{!! $item->motto !!}</div>
                                    </figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </section>
                    <hr class="mt-5">
                    <div class="title text-center mt-5 mb-4" data-aos="fade-up" data-aos-duration="1000">
                        <div class="shape2" data-aos="fade-up" data-aos-duration="1000"></div>
                        <h2>Pengurus PPGT
                            <br>
                            <span>Jemaat Satria Kasih</span>
                        </h2>
                    </div>
                    <div class="details">
                        <div class="row">
                            @php
                                $increment4 = 0;
                            @endphp
                            @foreach ($manajement as $item)
                                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up"
                                    data-aos-duration="{{ $increment4 += 1000 }}">
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
                                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up"
                                    data-aos-duration="{{ $increment4 += 1500 }}">
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
                <div class="content mb-3" data-aos="fade-up" data-aos-duration="1000">
                    <h2>Kontak</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-duration="2000">
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
                        <div class="card-body mt-4 mt-md-0 mt-lg-0" data-aos="fade-up" data-aos-duration="3000">
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


    <section class="sugf">
        <!-- Suggestion -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <section class="suggestion">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-10 offset-lg-1">
                                    <div class="content " data-aos="fade-up" data-aos-duration="1000">
                                        <h2>Saran</h2>
                                    </div>
                                    <p class="text-muted" data-aos="fade-up" data-aos-duration="1500">
                                        Berikan saran anda untuk membuat PPGT Jemaat Satria Kasih lebih baik lagi!
                                    </p>
                                    <form action="{{ route('user.saran') }}" method="post" data-aos="fade-up"
                                        data-aos-duration="25000">
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


                </div>
                <div class="col-12 col-lg-6">
                    <section class="faq-section">
                        <div class="container">
                            <div class="row">
                                <!-- ***** FAQ Start ***** -->
                                <div class="col-md-12">

                                    <div class="faq-title text-center pb-3" data-aos="fade-up" data-aos-duration="1000">
                                        <h2>FAQ</h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="faq" id="accordion" data-aos="fade-up" data-aos-duration="2000">
                                        @php
                                            $increment5 = 0;
                                        @endphp
                                        @foreach ($faq as $index => $item)
                                            <div class="card" data-aos="fade-up"
                                                data-aos-duration="{{ $increment5 += 1000 }}">
                                                <div class="card-header" id="faqHeading-{{ $index }}">
                                                    <div class="mb-0">
                                                        <h5 class="faq-title" data-toggle="collapse"
                                                            data-target="#faqCollapse-{{ $index }}"
                                                            data-aria-expanded="true"
                                                            data-aria-controls="faqCollapse-{{ $index }}">
                                                            <i class="fa-solid fa-plus" style="color: #006eff"></i>
                                                            {{ $item->pertanyaan }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div id="faqCollapse-{{ $index }}" class="collapse"
                                                    aria-labelledby="faqHeading-{{ $index }}"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <p>{!! $item->jawaban !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-script')
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
    <script>
        $(document).ready(function() {
            // Menambahkan event listener pada elemen dengan class .faq-title
            $('.faq-title').click(function() {
                // Mengambil atribut data-target yang berisi ID dari elemen yang akan dikompres atau diperluas
                var target = $(this).attr('data-target');

                // Memeriksa apakah elemen target sedang dalam keadaan terkompres atau diperluas
                if ($(target).hasClass('show')) {
                    // Jika sedang dalam keadaan terkompres, maka diperluas
                    $(target).collapse('hide');
                } else {
                    // Jika sedang dalam keadaan diperluas, maka dikompres
                    $(target).collapse('show');
                }
            });
        });
    </script>
@endpush
