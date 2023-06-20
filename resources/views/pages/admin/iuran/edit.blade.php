@extends('layouts.admin')

@section('title')
    Admin Iuran
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('iuran.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Edit Iuran PPGT</span>
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
                <form action="{{ route('iuran.update', $iuran->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="nama" class="mb-2">Nama Anggota <span class="star">*</label>
                    <input type="text" name="nama" id="nama" class="form-control mb-4"
                        value="{{ $iuran->nama }}">

                    <label for="kelompok" class="mb-2">Kelompok <span class="star">*</label>
                    <select name="kelompok" id="" class="form-select mb-4">
                        <option value="Kelompok 1">Kelompok 1</option>
                        <option value="Kelompok 2">Kelompok 2</option>
                    </select>

                    <label for="keterangan" class="mb-2">Keterangan (Lunas) <span class="star">*</label>
                    <select name="keterangan" id="" class="form-select mb-4">
                        <option value="{{ $iuran->keterangan }}">{{ $iuran->keterangan }}</option>
                        @foreach ($keteranganOptions as $item)
                            <option value="{{ $item }}" @if ($item == $iuran->keterangan) selected @endif>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>

                    <label for="jumlah" class="mb-2">Nominal <span class="star">*</label>
                    <input type="number" class="form-control" name="jumlah" value="{{ $iuran->jumlah }}">

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
