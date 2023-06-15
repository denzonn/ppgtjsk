@extends('layouts.admin')

@section('title')
    Admin Bidang Pengurus
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pengurus.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Bidang Pengurus</span>

                <div class="mt-3">
                    <a href="{{ route('bidang.create') }}" class="btn btn-primary">Tambahkan Bidang</a>
                </div>
            </div>
            <div class="card-body">
                {{-- Datatable --}}
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 30%">Foto</th>
                                <th style="width: 30%">Nama</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bidang as $item)
                                <tr></tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ Storage::url($item->foto_bidang) }}" alt=""
                                        style="max-width: 400px">
                                </td>
                                <td>{{ $item->nama_bidang }}</td>
                                <td class="text-center">
                                    <a href="{{ route('bidang.edit', $item->id) }}" class="btn btn-warning"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('bidang.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
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
