@extends('layouts.admin')

@section('title')
    Admin Jenis Inventaris
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('jenis-inventaris.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Jenis Inventaris PPGT</span>
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
                <form action="{{ route('jenis-inventaris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="nama" class="mb-2">Nama <span class="star">*</label>
                    <input type="text" name="nama" id="nama" class="form-control mb-4"
                        placeholder="Masukkan Jenis Inventaris">
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
