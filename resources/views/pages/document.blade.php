@extends('layouts.app')

@section('title')
    Dokument - PPGT Jemaat Satria Kasih
@endsection


@section('content')
    <!-- Content -->
    <div class="document">
        <div class="container">
            <div class="content">
                <h2>Dokument PPGT</h2>
                <p class="text-muted">
                    "Silahkan download dokumen PPGT dibawah ini"
                </p>

                <!-- Search -->
                <div class="search">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Dokumen">
                        <button class="btn btn-outline-secondary" type="button">Cari</button>
                    </div>
                </div>
                <!-- Search -->

                <!-- Document -->
                <div class="download">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title">
                                        <h5><i class="fa-regular fa-folder-open"></i> Anggaran Dasar dan Anggaran Rumah
                                            Tangga <span>(17kb)</span></h5>
                                    </div>
                                    <div class="downloads text-end">
                                        <a href="#" class="btn btn-download">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Document -->

            </div>
        </div>
    </div>
    <!-- Content -->
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
@endpush
