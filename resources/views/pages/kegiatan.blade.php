@extends('layouts.app')

@section('title')
    Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <!-- Gallery -->
    <section class="kegiatan">
        <div class="container">
            <div class="content mt-5 mb-3" data-aos="fade-up" data-aos-duration="1000">
                <h2>Kegiatan PPGT JSK</h2>
            </div>
            <div class="fill" data-aos="fade-up" data-aos-duration="1000">
                <button class="btn" onclick="toggleDropdown()"><span>Pilih Bidang</span><i
                        class="material-icons">public</i>
                    <ul class="dropdown drops" style="z-index: 99">
                        @foreach ($bidang as $item)
                            <li>
                                <a href="#"
                                    onclick="showPage('{{ $item->nama_bidang }}')">{{ $item->nama_bidang }}</a>
                            </li>
                        @endforeach
                    </ul>
                </button>
            </div>

            <div class="kegiatan-photo mt-2" id="kegiatan-photo" style="z-index: 1;">
                @foreach ($bidang as $index => $item)
                    <div id="{{ $item->nama_bidang }}" class="page {{ $index === 0 ? ' active' : '' }}">
                        <div class="row">
                            @php
                                $increment = 0;
                            @endphp
                            @foreach ($kegiatan[$item->id] as $kegiatanItem)
                                <div class="col-12 col-lg-6 mt-3 mt-lg-0" data-aos="fade-up"
                                    data-aos-duration="{{ $increment += 1000 }}">
                                    <article class="blog-post p-4 p-lg-0">
                                        <div class="blog-post__img">
                                            <img src="{{ Storage::url($kegiatanItem->photo) }}" alt="" />
                                        </div>
                                        <div class="blog-post__info">
                                            <div class="blog-post__date">
                                                <span>{{ $kegiatanItem->program->name }}</span>
                                            </div>
                                            <h2 class="blog-post__title">{{ $kegiatanItem->name }}</h2>
                                            @if (strlen($kegiatanItem->description) > 100)
                                                <p>{!! substr($kegiatanItem->description, 0, 100) !!}....</p>
                                            @else
                                                <p>{!! $kegiatanItem->description !!}</p>
                                            @endif
                                            <div>
                                                <a href="{{ route('kegiatan-detail', $kegiatanItem->slug) }}"
                                                    class="blog-post__cta">Read More</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
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
            var dropdown = document.querySelector('.drops');
            var kegiatanPhoto = document.getElementById('kegiatan-photo');

            if (dropdown.style.display === 'none') {
                // Ketika dropdown tampil
                dropdown.style.display = 'block';
                kegiatanPhoto.style.zIndex = '-1';
            } else {
                // Ketika dropdown disembunyikan
                dropdown.style.display = 'none';
                kegiatanPhoto.style.zIndex = '1';
            }
        }

        // Event listener untuk menutup dropdown dan mengembalikan z-index gallery-photo saat mengklik di luar dropdown
        document.addEventListener('mousedown', function(event) {
            var dropdown = document.querySelector('.drops');
            var kegiatanPhoto = document.getElementById('kegiatan-photo');
            var targetElement = event.target;

            // Jika yang diklik bukan bagian dropdown atau button dropdown, maka sembunyikan dropdown dan kembalikan z-index gallery-photo
            if (!dropdown.contains(targetElement) && !targetElement.classList.contains('btn')) {
                dropdown.style.display = 'none';
                kegiatanPhoto.style.zIndex = '1';
            }
        });
    </script>
    <!-- Pages -->

    <script>
        lightbox.option({
            'maxWidth': 800,
            'maxHeight': 600,
        })
    </script>
@endpush
