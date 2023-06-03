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
                        PENGURUS PPGT 2020 - 2022
                    </h1>
                    <div class="text" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="500">
                        1 Korintus 3:11 (TB) Karena tidak ada seorang pun yang dapat
                        meletakkan dasar lain dari pada dasar yang telah diletakkan, yaitu
                        Yesus Kristus.
                    </div>
                    <a href="#" class="activities btn mt-2" data-aos="fade-up" data-aos-duration="1500"
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
                <div class="video-container">
                    <iframe height="300" src="https://www.youtube.com/embed/KPlDkZhFPis" frameborder="0"
                        allowfullscreen></iframe>
                </div>
                <div class="description">
                    <h4 class="sub">PAKEI TU PAREANA PUANG (Pakailah Senjata Allah)</h3>
                        <p>
                            Buda tau ussattuan kabattaranna apa ro’pok bangsia, den duka tu
                            mukkun ka’tu rannu na tibambang pissan. Tae’ gai’na tu ussattuan
                            kale belanna iatu ditingayo tannia apa “mentolino” sangadinna
                            “petua’ ba’tangna deata bulituk”(ay.11b) sia “pangulunnan parenta
                            kamalillinan sola mintu’ kuasa masussuk dao langi’ (ay.12).
                            Manassa inang mawatang tu uali tatingayo belanna inang masussuk
                            (jahat), sia bulituk (licik). senga’pito misa’ apa tang nakita
                            mata belanna ma’paren lan kamallinan. Apamo la dipogau’? Kadanna
                            Puang nakua, batta’komi lan Puang sia ke’de’ko mengea sisola
                            Puang. Manassa sisolapiki’ Puang anta belai bendan matoto’
                            untingayoi tu uali tang payan na tiro mata iamotu deata bulituk,
                            ondongpiraka, napakinalloimiki’ Puang pa’buno (senjata) sundun
                            susi parea (alat) napake surodadu lan kapararian.Ia tu Pa’buno lu
                            diomai Puang iamotu:Umpotambeke’ kamanapparan, umpokararran
                            kamaloloan, umpolapik kamatinurusan, umpobalulang kapatonganan,
                            songko’ bassi kamakarimmanan, sia pa’dang Penaa. Puang umbenki’
                            kawatangan sia IA umpasakka’i tu pa’buno la dipake parari.
                            Tapatongan siaraka sia la morai tongan siaki’raka sisola sia la
                            napake Puang? Pembudaki’ tu ussattuan kaleta, nenne’ki’ tu mataku’
                            dolo napakataku’ penanta sia pa’peranginta belanna tae’mo na lu
                            lako Puang tu penaanta sia tanga’ta, belanna nakuasaimo a’gan lino
                            moiraka na mukkun bang tu pudukta unsa’bu sanganNa Puang. Ta
                            mengkatoba’mo belanna, tontong ma’dioren tu Puang umba’rui
                            katuoanta,mepamatoto’ sia na pakinalloi sanda parea mendadi
                            pa’buno la untingayoi mintu’na a’gan lan te lino. Nakua londe
                            Toraya “To mentiruranki’ kita, to lumio’ lan lino, Ta toyanganmi
                            iluanna pa’kalean” (Londe-londe toraya no.1122) amin
                        </p>
                </div>
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
    <section class="activity mb-5">
        <div class="container">
            <div class="content ">
                <h2>Kegiatan PPGT</h2>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mt-2">
                    <div class="card">
                        <img src="/assets/images/badminton.jpg" alt="">
                        <div class="description">
                            <h3>Badminton</h3>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam dolore unde illum, autem
                                ducimus illo
                                deleniti minima reprehenderit tenetur. Sit, consequatur ipsa. Laboriosam modi repellat
                                voluptatum sunt
                                id cupiditate hic! lore</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mt-2">
                    <div class="card">
                        <img src="/assets/images/pengurus.jpg" alt="">
                        <div class="description">
                            <h3>Badminton</h3>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam dolore unde illum, autem
                                ducimus illo
                                deleniti minima reprehenderit tenetur. Sit, consequatur ipsa. Laboriosam modi repellat
                                voluptatum sunt
                                id cupiditate hic! lore</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
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
                yang pasti akan membuat Anda terinspirasi."
            </p>
        </div>
        <div class="owl-carousel owl-theme" id="owl-carousel2">
            <a href="#" class="item">
                <img src="/assets/images/badminton.jpg" alt="Gambar Gallery" />
            </a>
            <a href="#" class="item">
                <img src="/assets/images/badminton.jpg" alt="Gambar Gallery" />
            </a>
            <a href="#" class="item">
                <img src="/assets/images/badminton.jpg" alt="Gambar Gallery" />
            </a>
            <a href="#" class="item">
                <img src="/assets/images/badminton.jpg" alt="Gambar Gallery" />
            </a>
            <a href="#" class="item">
                <img src="/assets/images/badminton.jpg" alt="Gambar Gallery" />
            </a>
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
                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="pic" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/resky.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <div class="name">Resky Palimbinan</div>
                                    <div class="position">Ketua</div>
                                    <div class="motto">"Engkau harus takut akan TUHAN, Allahmu; kepada Dia haruslah engkau
                                        beribadah dan
                                        demi nama-Nya haruslah engkau
                                        bersumpah."</div>
                                    <div class="socialmedia">
                                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="pic" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/pic1.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <div class="name">Hardianto Tandi Seno</div>
                                    <div class="position">Sekretaris</div>
                                    <div class="motto">"Carilah dahulu kerajaan Allah maka semuanya akan ditambahkan
                                        kepadamu "</div>
                                    <div class="socialmedia">
                                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="pic" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/pic1.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <div class="name">Anggun Chelseani Kati</div>
                                    <div class="position">Wakil Sekretaris</div>
                                    <div class="motto">"God is our refuge and strength, a very present help in trouble."
                                    </div>
                                    <div class="socialmedia">
                                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-6 col-md-6 col-lg-4 offset-lg-4 mt-lg-5">
                                <div class="pic" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/ireneb.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <div class="name">Irene Aprianti Baan</div>
                                    <div class="position">Bendahara</div>
                                    <div class="motto">"Grateful for everything"</div>
                                    <div class="socialmedia">
                                        <a href="https://www.instagram.com/ireneaprianti/"><i
                                                class="fa-brands fa-instagram"></i></a>
                                        <a href="https://wa.me/6285242856033"><i class="fa-brands fa-whatsapp"></i></a>
                                        <a href="https://www.facebook.com/ireneaprt"><i
                                                class="fa-brands fa-facebook"></i></a>
                                    </div>
                                </div>
                            </div>
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
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="image" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/badminton.jpg" alt="">
                                </div>
                                <div class="description">
                                    <div class="sector">Bidang Manajement</div>
                                    <div class="name">Ketua : Resky Palimbinan</div>
                                    <div class="name">Sekretaris : Hardianto Tandiseno</div>
                                    <div class="name">Wakil Sekretaris : Anggun Chelseani K.</div>
                                    <div class="name">Bendahara : Irene Aprianti Baan</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="image" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/badminton.jpg" alt="">
                                </div>
                                <div class="description">
                                    <div class="sector">Bidang Pengakaran dan Spiritualitas</div>
                                    <div class="name">Koordinator : Ega Yuni Betony</div>
                                    <div class="name">Anggota : </div>
                                    <ol>
                                        <li>
                                            <div class="name">Holy Rumpun Bato</div>
                                        </li>
                                        <li>
                                            <div class="name">Roland Deavid Benyamin</div>
                                        </li>
                                        <li>
                                            <div class="name">Vingky Maisel Tianglangi</div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="image" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/badminton.jpg" alt="">
                                </div>
                                <div class="description">
                                    <div class="sector">Bidang Organisasi</div>
                                    <div class="name">Koordinator : Yefta Tolla</div>
                                    <div class="name">Anggota : </div>
                                    <ol>
                                        <li>
                                            <div class="name">Vicci Juanito P.</div>
                                        </li>
                                        <li>
                                            <div class="name">Sheryl Maria T.</div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="image" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/badminton.jpg" alt="">
                                </div>
                                <div class="description">
                                    <div class="sector">Bidang SDM</div>
                                    <div class="name">Koordinator : Gabriel Sihow P.</div>
                                    <div class="name">Anggota : </div>
                                    <ol>
                                        <li>
                                            <div class="name">Lopinta Sarungallo</div>
                                        </li>
                                        <li>
                                            <div class="name">Yogi Limbong</div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="image" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/badminton.jpg" alt="">
                                </div>
                                <div class="description">
                                    <div class="sector">Bidang Pelsos</div>
                                    <div class="name">Koordinator : Irene Lolongan</div>
                                    <div class="name">Anggota : </div>
                                    <ol>
                                        <li>
                                            <div class="name">Nio Bungkudapun</div>
                                        </li>
                                        <li>
                                            <div class="name">Advendito Patanduk</div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="image" data-tilt data-tilt-max="10" data-tilt-speed="400"
                                    data-tilt-perspective="700">
                                    <img src="/assets/images/badminton.jpg" alt="">
                                </div>
                                <div class="description">
                                    <div class="sector">Koodinator Kelompok</div>
                                    <div class="name">Koord. Kel 1 : Devyanto Ambasalu S.</div>
                                    <div class="name">Wakoord. Kel 1 : Krismato Restan U.</div>
                                    <div class="name">Koord. Kel 2 : Euro Angelo B.</div>
                                    <div class="name">Wakoord. Kel 2 : Elvin Tulungalo</div>
                                </div>
                            </div>
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
                                <img src="/assets/images/bca.png" alt=""> 548-513132-6
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
                    <form action="">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="mt-3">Saran</label>
                            <textarea></textarea>
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
@endpush
