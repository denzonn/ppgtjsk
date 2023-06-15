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
                <span class="title">Edit Invetaris PPGT</span>
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
                <form action="{{ route('inventaris.update', $inventaris->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="nama" class="mb-2">Nama <span class="star">*</label>
                    <input type="text" name="nama" id="nama" class="form-control mb-4"
                        value="{{ $inventaris->nama }}">

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="kode" class="mb-2">Kode <span class="star">*</label>
                            <input type="text" name="kode" id="kode" class="form-control mb-4"
                                value="{{ $inventaris->kode }}">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="jenis_id" class="mb-2">Jenis Inventaris <span class="star">*</label>
                            <select name="jenis_id" id="" class="form-select mb-4">
                                <option value="{{ $inventaris->jenis_id }}">{{ $inventaris->jenis->nama }}</option>
                                @foreach ($jenisInventaris as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="jumlah" class="mb-2">Jumlah <span class="star">*</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control mb-4"
                                value="{{ $inventaris->jumlah }}">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label for="keterangan" class="mb-2">Keterangan <span class="star">*</label>
                            <select name="keterangan" id="" class="form-select mb-4">
                                <option value="{{ $inventaris->keterangan }}">{{ $inventaris->keterangan }}</option>
                                @foreach ($keteranganNoChoose as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="photo" class=" mb-2">Foto </label>
                    <div style="color: red"><span class="star">* Jika tidak ingin mengganti foto tidak perlu upload
                    </div>
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
