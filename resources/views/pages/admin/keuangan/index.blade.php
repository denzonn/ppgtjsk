@extends('layouts.admin')

@section('title')
    Admin Keuangan
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Keuangan PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="keuangan">
            <div class="row">
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <a href="{{ route('pemasukan.index') }}">
                        <div class="card"
                            style="position: relative;height: 200px; background-image: url('../../images/income.jpg'); background-size: cover; background-position: top;">
                            <div class="card-body">
                                <h4>Pemasukan</h4>
                            </div>
                            <div class="inner-shadow"></div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <a href="{{ route('pengeluaran.index') }}">
                        <div class="card"
                            style="position: relative;height: 200px; background-image: url('../../images/spending.jpg'); background-size: cover; background-position: top;">
                            <div class="card-body">
                                <h4>Pengeluaran</h4>
                            </div>
                            <div class="inner-shadow"></div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <a href="{{ route('piutang.index') }}">
                        <div class="card"
                            style="position: relative;height: 200px; background-image: url('../../images/piutang.jpg'); background-size: cover; background-position: top;">
                            <div class="card-body">
                                <h4>Piutang</h4>
                            </div>
                            <div class="inner-shadow"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <span class="title">Laporan Keuangan PPGT</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="print">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 20%">Tanggal Masuk/Keluar</th>
                                <th style="width: 50%">Keterangan</th>
                                <th style="width: 20%">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keuangan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    </td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>Rp. {{ number_format($item->jumlah, 0, ',', '.') }}</td>
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
                    'copy', 'csv', 'excel', 'print'
                ],

            });
        });
    </script>
@endpush
