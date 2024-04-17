@extends('layouts.admin')

@section('title')
    Admin Link Terkait
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('link-terkait.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Edit Link Terkait PPGT</span>
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
                <form action="{{ route('link-terkait.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="nama" class="mb-2">Label <span class="star">*</label>
                        <input type="text" name="label" id="label" class="form-control mb-4"
                            placeholder="Masukkan Label" value="{{ $data->label }}">
                        <label for="nama" class="mb-2">Link <span class="star">*</label>
                        <input type="text" name="link" id="link" class="form-control mb-4"
                            placeholder="Masukkan Link" value="{{ $data->link }}">
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
