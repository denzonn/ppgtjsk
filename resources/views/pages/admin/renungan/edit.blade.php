@extends('layouts.admin')

@section('title')
    Admin Renungan Harian
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('renungan-harian.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Renungan Harian</span>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('renungan-harian.update', $renungan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="judul" class="mb-2">Judul Renungan</label>
                    <input type="text" name="judul" id="judul" class="form-control mb-4"
                        value="{{ $renungan->judul }}">

                    <label for="ayat" class="mb-2">Ayat</label>
                    <input type="text" name="ayat" id="ayat" class="form-control mb-4"
                        value="{{ $renungan->ayat }}">

                    <label for="isi" class="mb-2">Isi</label>
                    <textarea name="isi" id="isi" cols="30" rows="10" class="form-control">{!! $renungan->isi !!}</textarea>

                    <label for="url_youtube" class="mt-4 mb-2">Url Youtube</label>
                    <input type="text" name="url_youtube" id="url_youtube" class="form-control mb-4"
                        value="{{ $renungan->url_youtube }}">

                    <button type="submit" class="btn btn-primary btn-block w-100">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#isi'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
