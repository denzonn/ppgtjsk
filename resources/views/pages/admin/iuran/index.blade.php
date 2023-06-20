@extends('layouts.admin')

@section('title')
    Admin Iuran
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Iuran PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Iuran</h4>
                <a href="{{ route('iuran.create') }}" class="btn btn-primary">Tambah Iuran</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 15%">Kelompok</th>
                                <th style="width: 20%">Keterangan</th>
                                <th style="width: 20%">Jumlah</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($iuran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelompok }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>Rp. {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('iuran.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                                class="fas fa-edit"></i></a>
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
