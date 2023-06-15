@extends('layouts.admin')

@section('title')
    Admin Program Kerja
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('program-kerja.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Program Kerja PPGT</span>
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
                <form action="{{ route('program-kerja.update', $program->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="name" class="mb-2">Nama Program Kerja <span class="star">*</label>
                    <input type="text" name="name" id="name" class="form-control mb-4"
                        placeholder="Masukkan Nama Program" value="{{ $program->name }}">

                    <label for="bidang_id" class="mb-2">Bidang <span class="star">*</label>
                    <select name="bidang_id" class="form-select mb-4">
                        <option value="{{ $program->bidang_id }}" selected>{{ $program->bidang->nama_bidang }}</option>
                        @foreach ($bidang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_bidang }}</option>
                        @endforeach
                    </select>

                    <label for="description" class="mb-2">Deskripsi Kegiatan <span class="star">*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{!! $program->description !!}</textarea>

                    <button type="submit" class="btn btn-primary btn-block w-100 mt-4">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
