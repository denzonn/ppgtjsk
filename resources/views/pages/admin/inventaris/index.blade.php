@extends('layouts.admin')

@section('title')
    Admin Inventaris
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Inventaris PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Inventaris</h4>
                <a href="{{ route('inventaris.create') }}" class="btn btn-primary">Tambah Inventaris</a>
                <a href="{{ route('jenis-inventaris.index') }}" class="btn btn-outline-primary">Input Jenis Inventaris</a>
                <a href="{{ route('inventaris.print') }}" class="btn btn-secondary">Print</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 10%">Kode</th>
                                <th style="width: 10%">Jenis Inventaris</th>
                                <th style="width: 10%">Jumlah</th>
                                <th style="width: 10%">Keterangan</th>
                                <th style="width: 20%">Foto</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventaris as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->jenis->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->photo) }}" alt="" width="100px">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('inventaris.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
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
