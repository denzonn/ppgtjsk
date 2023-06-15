@extends('layouts.admin')

@section('title')
    Admin Notulensi Rapat
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('notulensi-rapat.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Notulensi Rapat PPGT</span>
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
                <form action="{{ route('notulensi-rapat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="tanggal" class="mb-2">Tanggal <span class="star">*</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control mb-4">

                    <label for="judul" class="mb-2">Judul <span class="star">*</label>
                    <input type="text" name="judul" id="judul" class="form-control mb-4">

                    <label for="isi" class="mb-2">Isi <span class="star">*</label>
                    <textarea name="isi" id="isi" cols="30" rows="10"></textarea>

                    <label for="file" class="mt-4 mb-2">File <span class="star">*</label>
                    <input type="file" name="file" class="form-control">

                    <button type="submit" class="btn btn-primary btn-block w-100 mt-4">Simpan</button>
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
