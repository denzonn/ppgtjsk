@extends('layouts.admin')

@section('title')
    Admin Kegiatan Mingguan
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Kegiatan Mingguan PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Kegiatan Mingguan</h4>
                <a href="{{ route('kegiatan-mingguan.create') }}" class="btn btn-primary">Tambah Kegiatan Mingguan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 15%">Tanggal</th>
                                <th style="width: 20%">Nama Kegiatan</th>
                                <th style="width: 15%">Waktu</th>
                                <th style="width: 20%">Tempat</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->kegiatan->name }}</td>
                                    <td>{{ $item->waktu }}</td>
                                    <td>{!! $item->tempat !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('kegiatan-mingguan.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('kegiatan-mingguan.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
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
