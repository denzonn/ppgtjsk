@extends('layouts.admin')

@section('title')
    Admin Dokumen
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('document.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Dokumen PPGT</span>
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
                <form action="{{ route('document.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="judul" class="mb-2">Judul Dokumen <span class="star">*</label>
                    <input type="text" name="judul" id="judul" class="form-control mb-4"
                        value="{{ $document->judul }}">

                    <label for="file" class=" mb-2">File </label>
                    <div style="color: red"><span class="star">* Jika tidak ingin mengganti file tidak perlu upload</div>
                    <input type="file" name="file" class="form-control">

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
