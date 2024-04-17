@extends('layouts.admin')

@section('title')
    Admin Link Terkait
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Link Terkait PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('inventaris.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Link Terkait PPGT</span>
                <div class="mt-2">
                    <a href="{{ route('link-terkait.create') }}" class="btn btn-primary">Tambah Link Terkait</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 40%">Label</th>
                                <th style="width: 30%">Link</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->label }}</td>
                                    <td>{{ $item->link }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('link-terkait.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('link-terkait.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
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
