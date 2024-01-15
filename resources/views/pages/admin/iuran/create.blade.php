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
                <span class="title">Iuran PPGT</span>
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
                <form action="{{ route('iuran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="nama" class="mb-2">Nama Anggota <span class="star">*</label>
                    <input type="text" name="nama" id="nama" class="form-control mb-4" placeholder="Masukkan Nama Anggota">

                    <label for="kelompok" class="mb-2">Kelompok <span class="star">*</label>
                    <select name="kelompok" id="" class="form-select mb-4">
                        <option value="Kelompok 1">Kelompok 1</option>
                        <option value="Kelompok 2">Kelompok 2</option>
                    </select>

                    <label for="keterangan" class="mb-2">Keterangan (Lunas) <span class="star">*</label>
                    <select name="keterangan" id="" class="form-select mb-4">
                        <option value="Januari">Januari</option>
                        <option value="Januari-Februari">Januari-Februari</option>
                        <option value="Januari-Maret">Januari-Maret</option>
                        <option value="Januari-April">Januari-April</option>
                        <option value="Januari-Mei">Januari-Mei</option>
                        <option value="Januari-Juni">Januari-Juni</option>
                        <option value="Januari-Juli">Januari-Juli</option>
                        <option value="Januari-Agustus">Januari-Agustus</option>
                        <option value="Januari-September">Januari-September</option>
                        <option value="Januari-Oktober">Januari-Oktober</option>
                        <option value="Januari-November">Januari-November</option>
                        <option value="Januari-Desember">Januari-November</option>
                    </select>

                    <label for="jumlah" class="mb-2">Nominal <span class="star">*</label>
                    <input type="number" class="form-control" name="jumlah">

                    <label for="catatan" class="mb-2 mt-2">Catatan </label>
                    <textarea name="catatan" id="catatan" cols="30" rows="5" class="form-control mb-4"
                        placeholder="Masukkan Catatan Anda">{{ old('catatan') }}</textarea>

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
