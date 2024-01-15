@extends('layouts.admin')

@section('title')
    Admin Profil
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Profil PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Data Profil</h4>
                <a href="{{ route('profil-ppgt.create') }}" class="btn btn-primary">Tambah Sejarah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="profil">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 20%">Periode</th>
                                <th style="width: 60%">Konten</th>
                                <th style="width: 20%">Foto</th>
                                <th class="text-center" style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profil as $item)
                                <tr>
                                    <td>{{ $item->periode }}</td>
                                    <td>{!! $item->content !!}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->photo) }}" alt="foto" class="img-fluid"
                                            style="width: 100px; height: 100px; object-fit: cover; object-position: center;">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('profil-ppgt.edit', $item->id) }}"
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
