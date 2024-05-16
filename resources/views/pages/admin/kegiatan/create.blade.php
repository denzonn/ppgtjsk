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
                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="nama" class="mb-2">Nama Kegiatan <span class="star">*</label>
                            <input type="text" name="name" id="nama" class="form-control mb-4"
                                placeholder="Masukkan Nama Kegiatan">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="proker" class="mb-2">Nama Program Kerja <span class="star">*</label>
                            <select name="program_id" id="" class="form-select mb-4">
                                @foreach ($program as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <label for="description" class="mb-2">Deskripsi Kegiatan <span class="star">*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>

                    <label for="link_drive" class=" mb-2 mt-4">Link Drive</label>
                    <div class="row" id="link-inputs">
                        <div class="col-12 col-md-8">
                            <input type="text" name="link_drive[]" class="form-control mb-4" placeholder="Masukkan Link Google Drive">
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-primary add-link" type="button">Tambah Link</button>
                        </div>
                    </div>

                    <label for="photo" class=" mb-2">Foto Kegiatan <span class="star">*</label>
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
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.add-link').addEventListener('click', function () {
                var linkInputs = document.getElementById('link-inputs');
                var newRow = document.createElement('div');
                newRow.classList.add('row');
                newRow.innerHTML = `
                    <div class="col-12 col-md-8">
                        <input type="text" name="link_drive[]" class="form-control mb-4" placeholder="Masukkan Link Google Drive">
                    </div>
                    <div class="col-12 col-md-4">
                        <button class="btn btn-danger remove-link" type="button">Hapus Link</button>
                    </div>
                `;
                linkInputs.appendChild(newRow);
            });

            // Menambahkan event listener untuk menghapus link
            document.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('remove-link')) {
                    event.target.closest('.row').remove();
                }
            });
        });
    </script>

@endpush
