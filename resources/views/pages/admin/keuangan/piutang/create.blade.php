@extends('layouts.admin')

@section('title')
    Admin Keuangan - Piutang
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('piutang.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Piutang PPGT</span>
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
                <form action="{{ route('piutang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="keterangan" class="mb-2">Keterangan Piutang <span class="star">*</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control mb-4"
                        placeholder="Nama Pengutang">

                    <label for="jumlah" class="mb-2">Nominal <span class="star">*</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control mb-4"
                        placeholder="Masukkan Nominal Piutang">

                    <label for="catatan" class="mb-2">Catatan </label>
                    <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control"></textarea>

                    <label for="photo" class="mt-4 mb-2">Foto Slip </label>
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
            .create(document.querySelector('#catatan'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        // Mendapatkan elemen input tanggal
        const tanggalInput = document.getElementById('tanggal');

        // Mendapatkan tanggal hari ini
        const today = new Date().toISOString().split('T')[0];

        // Mengatur atribut max pada elemen input tanggal menjadi tanggal hari ini
        tanggalInput.setAttribute('max', today);
    </script>
@endpush
