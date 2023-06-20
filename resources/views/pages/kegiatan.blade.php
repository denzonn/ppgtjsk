@extends('layouts.app')

@section('title')
    Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <!-- Gallery -->
    <section class="kegiatan">
        <div class="container">
            <div class="content mt-5 mb-3">
                <h2>Kegiatan PPGT JSK</h2>
            </div>
            <div class="kegiatan-photo">
                <div class="row">
                    @foreach ($kegiatan as $item)
                        <div class="col-12 col-md-4 col-lg-4 mb-4">
                            <div class="giat">
                                <a href="{{ route('kegiatan-detail', $item->slug) }}">
                                    <img src="{{ Storage::url($item->photo) }}" alt="{{ $item->title }}" class="w-100"
                                        style="height: 250px; object-fit: cover; border-radius: 5px">
                                    <h5>{{ $item->name }}</h5>
                                </a>
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
