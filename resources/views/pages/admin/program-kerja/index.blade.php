@extends('layouts.admin')

@section('title')
    Admin Program Kerja
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Program Kerja PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Program Kerja</h4>
                <a href="{{ route('program-kerja.create') }}" class="btn btn-primary">Tambah Program Kerja</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 20%">Bidang</th>
                                <th style="width: 30%">Deskripsi</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($program as $item)
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->bidang->nama_bidang }}</td>
                                <td>{!! $item->description !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('program-kerja.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('program-kerja.destroy', $item->id) }}" method="POST"
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
