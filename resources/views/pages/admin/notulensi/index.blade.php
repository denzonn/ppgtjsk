@extends('layouts.admin')

@section('title')
    Admin Notulensi Rapat
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Notulensi Rapat PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Notulensi Rapat</h4>
                <a href="{{ route('notulensi-rapat.create') }}" class="btn btn-primary">Tambah Notulensi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 10%">Tanggal</th>
                                <th style="width: 20%">Judul</th>
                                <th style="width: 30%">Isi</th>
                                <th style="width: 10%">File</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notulensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{!! $item->isi !!}</td>
                                    <td>
                                        <a href="{{ Storage::url($item->file) }}" target="_blank">
                                            <button class="btn btn-outline-primary"><i class="fas fa-download"></i></button>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('notulensi-rapat.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('notulensi-rapat.destroy', $item->id) }}" method="POST"
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
