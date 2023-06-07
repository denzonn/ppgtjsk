@extends('layouts.admin')

@section('title')
    Admin Pengurus
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Pengurus PPGT</h3>
    </div>
    <div class="row text-center">
        <div class="col-12 col-lg-4 ">
            <a href="{{ route('jabatan.index') }}">
                <div class="pages text-center">
                    <div class="card input">
                        <div class="card-header ">
                            <h4><i class="fa-solid fa-star icon"></i> Input Jabatan</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-lg-4">
            <a href="{{ route('bidang.index') }}">
                <div class="pages text-center">
                    <div class="card input">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-layer-group icon"></i> Input Bidang</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-lg-4 ">
            <a href="{{ route('pengurus.create') }}">
                <div class="pages text-center">
                    <div class="card input">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-person icon"></i> Input Pengurus</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="pages pt-0">
        <div class="card">
            <div class="card-header">
                <h4>Data Pengurus</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 30%">Foto</th>
                                <th style="width: 20%">Jabatan</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengurus as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_anggota }}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->foto) }}" alt="" style="max-width: 200px">
                                    </td>
                                    <td>{{ $item->jabatan->nama_jabatan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pengurus.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pengurus.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
