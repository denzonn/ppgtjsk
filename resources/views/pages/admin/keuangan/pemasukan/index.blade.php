@extends('layouts.admin')

@section('title')
    Admin Keuangan - Pemasukan
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Keuangan PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('keuangan') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Data Pemasukan PPGT</span>
                <div>
                    <a href="{{ route('pemasukan.create') }}" class="btn btn-primary mt-3">Tambah Pemasukan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Tanggal Masuk</th>
                                <th style="width: 30%">Keterangan</th>
                                <th style="width: 20%">Jumlah</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasukan as $item)
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td>{{ $item->keterangan }}</td>
                                <td>Rp. {{ number_format($item->jumlah, 0, ',', '.') }}</td>

                                <td class="text-center">
                                    <a href="{{ route('pemasukan.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST"
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
