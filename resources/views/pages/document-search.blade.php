@extends('layouts.app')

@section('title')
    Dokument - PPGT Jemaat Satria Kasih
@endsection


@section('content')
    <!-- Content -->
    <div class="document">
        <div class="container">
            <div class="content" data-aos="fade-up" data-aos-duration="1000">
                <h2>Dokument PPGT</h2>
                <p class="text-muted">
                    "Silahkan download dokumen PPGT dibawah ini"
                </p>

                <!-- Search -->
                <div class="search" data-aos="fade-up" data-aos-duration="2000">
                    <form action="{{ route('document.search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Cari Dokumen">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
                <!-- Search -->

                <!-- Document -->
                <div class="download">
                    <div class="row">
                        @php
                            $increment = 2000;
                        @endphp
                        @foreach ($documents as $item)
                            <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up"
                                data-aos-duration="{{ $increment += 500 }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="title">
                                            <h5><i class="fa-regular fa-folder-open"></i> {{ $item->judul }}</h5>
                                        </div>
                                        <div class="downloads text-end">
                                            <a href="{{ Storage::url($item->file) }}" class="btn btn-download">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Document -->



            </div>
        </div>
    </div>
    <!-- Content -->
@endsection
