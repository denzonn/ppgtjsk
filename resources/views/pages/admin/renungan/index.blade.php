@extends('layouts.admin')

@section('title')
    Admin Renungan Harian
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Renungan Harian</h4>
            </div>
            <div class="card-body">
                {{-- Datatable --}}
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 20%">Judul</th>
                                <th style="width: 20%">Ayat</th>
                                <th style="width: 30%">Isi</th>
                                <th style="width: 20%">Url Youtube</th>
                                <th class="text-center" style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($renungan as $item)
                                <tr>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->ayat }}</td>
                                    <td>{!! $item->isi !!}</td>
                                    <td>{{ $item->url_youtube }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('renungan-harian.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
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
