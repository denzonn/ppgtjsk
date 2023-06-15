@extends('layouts.admin')

@section('title')
    Admin Kegiatan
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Kegiatan PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Kegiatan</h4>
                <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">Tambah Kegiatan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 10%">Foto</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 10%">Program Kerja</th>
                                <th style="width: 30%">Deskripsi</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $item)
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ Storage::url($item->photo) }}" alt="foto" class="img-fluid"
                                        style="width: 100px; height: 100px; object-fit: cover; object-position: center;">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->program->name }}</td>
                                <td>{!! $item->description !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('kegiatan.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST"
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
