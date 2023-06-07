@extends('layouts.admin')

@section('title')
    Admin Bidang Pengurus
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Tambahkan Bidang</h4>
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

                <form action="{{ route('bidang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="nama_bidang" class="mb-2">Nama <span class="star">*</span></label>
                    <input type="text" name="nama_bidang" id="nama_bidang" class="form-control mb-4"
                        placeholder="Masukkan Nama Bidang">

                    <label for="foto_bidang" class="mb-2">Foto <span class="star">*</span></label>
                    <input type="file" name="foto_bidang" id="foto_bidang" class="form-control mb-4">

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
