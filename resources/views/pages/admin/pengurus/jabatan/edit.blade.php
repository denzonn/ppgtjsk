@extends('layouts.admin')

@section('title')
    Admin Jabatan Pengurus
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Tambahkan Jabatan</h4>
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

                <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <label for="nama_jabatan" class="mb-2">Nama <span class="star">*</span></label>
                    <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control mb-4"
                        placeholder="Masukkan Nama Jabatan" value="{{ $jabatan->nama_jabatan }}">

                    <button type="submit" class="btn btn-primary btn-block w-100">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#motto'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
