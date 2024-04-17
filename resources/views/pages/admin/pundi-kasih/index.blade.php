@extends('layouts.admin')

@section('title')
    Admin Pundi Kasih
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Pundi Kasih</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Pundi Kasih</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 30%">Nama Bank</th>
                                <th style="width: 40%">No Rek</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pundiKasih as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->bank->name }}</td>
                                    <td>{{ $item->no_rek ? $item->no_rek : '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pundi-kasih.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
