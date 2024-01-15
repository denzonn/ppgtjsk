@extends('layouts.app')

@section('title')
    Profil - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <!-- History -->
    <section class="history">
        <div class="container">
            <div class="text-center">
                <h2>Profil PPGT</h2>
            </div>
            <div class="fill" data-aos="fade-up" data-aos-duration="1000">
                <button class="btn" onclick="toggleDropdown()"><span>Pilih Bidang</span><i class="material-icons">public</i>
                    <ul class="dropdown drops" style="z-index: 99">
                        @foreach ($profil as $item)
                            <li>
                                <a href="#" onclick="showPage('{{ $item->periode }}')">{{ $item->periode }}</a>
                            </li>
                        @endforeach
                    </ul>
                </button>
            </div>
            <div id="profil" style="z-index: 99;">
                @foreach ($profil as $index => $item)
                    <div id="{{ $item->periode }}" class="page {{ $index === 0 ? ' active' : '' }}" data-aos="fade-up" >
                        <div class="pt-2 w-full text-center " style="font-size: 22px">{{ $item->periode }}</div>
                        <div class="w-full text-center">
                            <img src="{{ Storage::url($item->photo) }}" alt="" style="height: 250px; width: auto" />
                        </div>
                        <div>{!! $item->content !!}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- History -->
@endsection

@push('addon-script')
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
            var kegiatanPhoto = document.getElementById('profil');

            if (dropdown.style.display === 'none') {
                // Ketika dropdown tampil
                dropdown.style.display = 'block';
                kegiatanPhoto.style.zIndex = '-5';
            } else {
                // Ketika dropdown disembunyikan
                dropdown.style.display = 'none';
                kegiatanPhoto.style.zIndex = '1';
            }
        }

        // Event listener untuk menutup dropdown dan mengembalikan z-index gallery-photo saat mengklik di luar dropdown
        document.addEventListener('mousedown', function(event) {
            var dropdown = document.querySelector('.drops');
            var kegiatanPhoto = document.getElementById('profil');
            var targetElement = event.target;

            // Jika yang diklik bukan bagian dropdown atau button dropdown, maka sembunyikan dropdown dan kembalikan z-index gallery-photo
            if (!dropdown.contains(targetElement) && !targetElement.classList.contains('btn')) {
                dropdown.style.display = 'none';
                kegiatanPhoto.style.zIndex = '1';
            }
        });
    </script>
@endpush
