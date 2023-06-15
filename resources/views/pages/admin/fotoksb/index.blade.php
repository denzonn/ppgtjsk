@extends('layouts.admin')

@section('title')
    Admin Foto KSB
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Foto KSB</h4>
            </div>
            <div class="card-body">
                {{-- Datatable --}}
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 20%">Jabatan</th>
                                <th style="width: 40%">Motto</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{!! $item->motto !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('foto-ksb.edit', $item->id) }}" class="btn btn-sm btn-warning"><i
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
