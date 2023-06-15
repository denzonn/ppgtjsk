@extends('layouts.admin')

@section('title')
    Admin Gallery Kegiatan
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Gallery Kegiatan PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Anggota</h4>
                <a href="{{ route('gallery-kegiatan.create') }}" class="btn btn-primary">Tambah Foto Kegiatan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 30%">Kegiatan</th>
                                <th style="width: 40%">Foto</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gallery as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kegiatan->name }}</td>
                                    <td class="lightgallery">
                                        <a href="{{ Storage::url($item->photo) }}" data-lg-size="1200-800" target="_blank">
                                            <img src="{{ Storage::url($item->photo) }}" alt="foto" class="img-fluid"
                                                style="width: 100px; height: 100px; object-fit: cover; object-position: center;">
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('gallery-kegiatan.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('.lightgallery').lightGallery({
                selector: 'a',
                download: false // Opsional: Menonaktifkan tombol unduh gambar
            });
        });
    </script>
@endpush
