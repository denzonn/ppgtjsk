@extends('layouts.admin')

@section('title')
    Admin Dokumen
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Dokument PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Kegiatan</h4>
                <a href="{{ route('document.create') }}" class="btn btn-primary">Tambah Dokumen</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 50%">Judul</th>
                                <th style="width: 20%">File</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumen as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>
                                        <a href="{{ Storage::url($item->file) }}" target="_blank">
                                            <button class="btn btn-outline-primary"><i class="fas fa-download"></i></button>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('document.edit', $item->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('document.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data?')"><i
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
