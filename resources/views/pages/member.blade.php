@extends('layouts.app')

@section('title')
    Keanggotaan - PPGT Jemaat Satria Kasih
@endsection

@push('addon-style')
    <link href="{{ asset('datatable/DataTables-1.13.4/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('datatable/Buttons-2.3.6/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('datatable/DataTables-1.13.4/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/DataTables-1.13.4/css/dataTables.jqueryui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/Buttons-2.3.6/css/buttons.dataTables.min.css') }}">
@endpush

@section('content')
    <!-- History -->
    <section class="keanggotaan">
        <div class="container">
            <div class="text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2>Iuran Anggota</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" data-aos="fade-up" data-aos-duration="2000">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th style="width: 30%">Nama</th>
                                    <th style="width: 20%">Kelompok</th>
                                    <th style="width: 40%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $increment = 2000;
                                @endphp
                                @foreach ($iuran as $item)
                                    <tr data-aos="fade-up" data-aos-duration="{{ $increment += 1000 }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kelompok }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- History -->
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('datatable/DataTables-1.13.4/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                searching: true,
                searchDelay: 500,
                search: {
                    smart: true
                },
            });
        });
    </script>
@endpush
