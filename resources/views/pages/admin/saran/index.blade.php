@extends('layouts.admin')

@section('title')
    Admin Saran
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Saran</h4>
            </div>
            <div class="card-body">
                {{-- Datatable --}}
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 70%">Saran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->saran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
