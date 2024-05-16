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
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="nama" class="mb-2">Nama Kegiatan <span class="star">*</label>
                            <input type="text" name="name" id="nama" class="form-control mb-4"
                                value="{{ $kegiatan->name }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="proker" class="mb-2">Nama Program Kerja <span class="star">*</label>
                            <select name="program_id" id="" class="form-select mb-4">
                                <option value="{{ $kegiatan->program_id }}">{{ $kegiatan->program->name }}</option>
                                @foreach ($program as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="description" class="mb-2">Deskripsi Kegiatan <span class="star">*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{!! $kegiatan->description !!}</textarea>

                    <label for="link_drive" class=" mb-2 mt-4">Link Drive</label>
                    <div class="row" id="link-inputs">

                        @if ($linkDrive)
                            @foreach ($linkDrive as $index => $link)
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <input type="text" name="link_drive[]" class="form-control mb-4"
                                            placeholder="Masukkan Link Google Drive" value="{{ $link }}">
                                    </div>
                                    @if ($index === 0)
                                        <div class="col-12 col-md-4">
                                            <button class="btn btn-primary add-link" type="button">Tambah Link</button>
                                        </div>
                                    @else
                                        <div class="col-12 col-md-4">
                                            <button class="btn btn-danger remove-link" type="button">Hapus Link</button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <input type="text" name="link_drive[]" class="form-control mb-4"
                                        placeholder="Masukkan Link Google Drive" >
                                </div>
                                <div class="col-12 col-md-4">
                                    <button class="btn btn-primary add-link" type="button">Tambah Link</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <label for="photo" class=" mb-2">Foto Kegiatan </label>
                    <p style="color: red; font-size: 0.8rem"><span class="star">* Tidak Perlu Upload Foto Jika Tidak Ingin
                            Ganti</p>
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
            .create(document.querySelector('#description'), {
                //tambahkan plugin upload gambar
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.add-link').addEventListener('click', function() {
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
            document.addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('remove-link')) {
                    event.target.closest('.row').remove();
                }
            });
        });
    </script>
@endpush
