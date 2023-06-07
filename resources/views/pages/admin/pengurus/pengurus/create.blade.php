@extends('layouts.admin')

@section('title')
    Admin Pengurus
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Tambahkan Pengurus</h4>
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

                <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="nama_anggota" class="mb-2">Nama <span class="star">*</span></label>
                    <input type="text" name="nama_anggota" id="nama_anggota" class="form-control mb-4"
                        placeholder="Masukkan Nama Pengurus">

                    <label for="jabatan" class="mb-2">Jabatan <span class="star">*</span></label>
                    <select name="jabatans_id" class="form-control mb-4">
                        @foreach ($jabatan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                        @endforeach
                    </select>

                    <label for="bidang" class="mb-2">Bidang <span class="star">*</span></label>
                    <select name="bidangs_id" class="form-control mb-4">
                        @foreach ($bidang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_bidang }}</option>
                        @endforeach
                    </select>

                    <label for="foto" class="mb-2">Foto <span class="star">*</span></label>
                    <input type="file" class="form-control mb-4" name="foto">

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