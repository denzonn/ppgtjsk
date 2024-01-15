@extends('layouts.admin')

@section('title')
    Admin Kegiatan Mingguan
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('kegiatan-mingguan.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Kegiatan Mingguan PPGT</span>
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
                <form action="{{ route('kegiatan-mingguan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="tanggal" class="mb-2">Tanggal <span class="star">*</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control mb-4">

                    <label for="kegiatan_id" class="mb-2">Kegiatan <span class="star">*</label>
                    <select name="kegiatan_id" id="" class="form-select mb-4">
                        @foreach ($kegiatan as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <label for="waktu" class="mb-2">Waktu <span class="star">*</label>
                    <input type="time" name="waktu" id="waktu" class="form-control mb-4">

                    <label for="maps" class="mb-2">Link Maps <span class="star">*</label>
                    <input type="text" name="maps" id="maps" class="form-control mb-4">

                    <label for="tempat" class="mb-2">Tempat <span class="star">*</label>
                    <textarea name="tempat" id="tempat" cols="30" rows="10"></textarea>

                    <button type="submit" class="btn btn-primary btn-block w-100 mt-4">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#tempat'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
