@extends('layouts.admin')

@section('title')
    Admin Inventaris
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Print Data Inventaris PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('inventaris.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Data Inventaris PPGT</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="print">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 10%">Kode</th>
                                <th style="width: 10%">Jenis Inventaris</th>
                                <th style="width: 10%">Jumlah</th>
                                <th style="width: 10%">Keterangan</th>
                                <th style="width: 20%">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventaris as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->jenis->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->photo) }}" alt="" width="100px">
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


@push('addon-script')
    <script src="{{ asset('datatable/Buttons-2.3.6/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatable/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('datatable/pdfmake-0.2.7/pdfmake.min.js') }}"></script>
    <script src="{{ asset('datatable/pdfmake-0.2.7/vfs_fonts.js') }}"></script>
    <script src="{{ asset('datatable/Buttons-2.3.6/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('datatable/Buttons-2.3.6/js/buttons.print.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#print').DataTable({
                searching: true,
                searchDelay: 500,
                search: {
                    smart: true
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print', 'pdf'
                ],

            });
        });
    </script>
@endpush
