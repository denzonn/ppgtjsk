@extends('layouts.admin')

@section('title')
    Admin Invetaris
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('inventaris.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Invetaris PPGT</span>
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
                <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="nama" class="mb-2">Nama <span class="star">*</label>
                    <input type="text" name="nama" id="nama" class="form-control mb-4">

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="kode" class="mb-2">Kode <span class="star">*</label>
                            <input type="text" name="kode" id="kode" class="form-control mb-4">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="jenis_id" class="mb-2">Jenis Inventaris <span class="star">*</label>
                            <select name="jenis_id" id="" class="form-select mb-4">
                                @foreach ($jenisInventaris as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="jumlah" class="mb-2">Jumlah <span class="star">*</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control mb-4">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label for="keterangan" class="mb-2">Keterangan <span class="star">*</label>
                            <select name="keterangan" id="" class="form-select mb-4">
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Hilang">Hilang</option>
                            </select>
                        </div>
                    </div>

                    <label for="photo" class=" mb-2">Foto <span class="star">*</label>
                    <input type="file" name="photo" class="form-control">

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
