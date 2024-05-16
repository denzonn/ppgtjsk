@extends('layouts.admin')

@section('title')
    Admin Artikel
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Artikel PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Artikel</h4>
                <a href="{{ route('artikel.create') }}" class="btn btn-primary">Tambah Artikel</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Foto</th>
                                <th style="width: 50%">Judul</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->photo) }}" alt="foto" class="img-fluid"
                                            style="width: 100px; height: 100px; object-fit: cover; object-position: center;">
                                    </td>
                                    <td>{{ $item->judul }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('artikel.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('artikel.destroy', $item->id) }}" method="POST"
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

