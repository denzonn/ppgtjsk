@extends('layouts.admin')

@section('title')
    Admin Gallery Kegiatan
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('gallery-kegiatan.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Gallery Kegiatan PPGT</span>
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
                <form action="{{ route('gallery-kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="kegiatan" class="mt-4 mb-2">Nama Kegiatan <span class="star">*</label>
                    <select name="kegiatan_id" class="form-select">
                        @foreach ($kegiatan as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <label for="photo" class="mt-4 mb-2">Foto Kegiatan <span class="star">*</label>
                    <input type="file" name="photo[]" class="form-control" multiple>

                    <button type="submit" class="btn btn-primary btn-block w-100 mt-4">Simpan</button>
                </form>

            </div>
        </div>
    </div>
@endsection
