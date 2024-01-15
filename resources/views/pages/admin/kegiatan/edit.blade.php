@extends('layouts.admin')

@section('title')
    Admin Kegiatan
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('kegiatan.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Kegiatan PPGT</span>
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
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="nama" class="mb-2">Nama Kegiatan <span class="star">*</label>
                    <input type="text" name="name" id="nama" class="form-control mb-4"
                        value="{{ $kegiatan->name }}">

                    <label for="proker" class="mb-2">Nama Program Kerja <span class="star">*</label>
                    <select name="program_id" id="" class="form-select mb-4">
                        <option value="{{ $kegiatan->program_id }}">{{ $kegiatan->program->name }}</option>
                        @foreach ($program as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <label for="description" class="mb-2">Deskripsi Kegiatan <span class="star">*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{!! $kegiatan->description !!}</textarea>

                    <label for="link_drive" class="mt-4 mb-2">Link Drive </label>
                        <input type="text" name="link_drive" id="link_drive" class="form-control mb-4" value={{ $kegiatan->link_drive }}>

                    <label for="photo" class=" mb-2">Foto Kegiatan </label>
                    <p style="color: red; font-size: 0.8rem"><span class="star">* Tidak Perlu Upload Foto Jika Tidak Ingin
                            Ganti</p>
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
            .create(document.querySelector('#description'), {
                //tambahkan plugin upload gambar
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
