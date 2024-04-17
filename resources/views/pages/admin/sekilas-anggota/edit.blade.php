@extends('layouts.admin')

@section('title')
    Admin Profil
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('sekilas-anggota.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Sekilas Anggota</span>
            </div>
            <div class="card-body" id="profil">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('sekilas-anggota.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="content" class="mb-2">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{!! $data->description !!}</textarea>

                    <button type="submit" class="btn btn-primary btn-block w-100 mt-4">Ubah</button>
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
