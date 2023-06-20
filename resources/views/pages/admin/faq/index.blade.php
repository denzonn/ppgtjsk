@extends('layouts.admin')

@section('title')
    Admin Frequenly Ask Question
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Frequenly Ask Question</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Frequenly Ask Question</h4>
                <a href="{{ route('faq.create') }}" class="btn btn-primary">Tambah FAQ</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 30%">Pertanyaan</th>
                                <th style="width: 40%">Jawaban</th>
                                <th class="text-center" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faq as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pertanyaan }}</td>
                                    <td>{!! $item->jawaban !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('faq.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('faq.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
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
