@extends('layouts.admin')

@section('title')
    Admin Keuangan - Piutang
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
                <span class="title">Data Piutang PPGT</span>
                <div>
                    <a href="{{ route('piutang.create') }}" class="btn btn-primary mt-3">Tambah Piutang</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Keterangan</th>
                                <th style="width: 20%">Jumlah</th>
                                <th style="width: 20%">Catatan</th>
                                <th style="width: 20%">Foto</th>
                                <th class="text-center" style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($piutang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>Rp. {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td>{!! $item->catatan !!}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->photo) }}" alt="foto" width="100px">
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status == 'Belum Lunas')
                                            <a href="{{ route('piutang.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        @else
                                            <button class="btn btn-success">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </button>
                                        @endif
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
