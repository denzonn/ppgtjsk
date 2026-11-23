@extends('layouts.admin')

@section('title')
    Admin Inventaris
@endsection

@section('content')
    <div class="py-2.5 pl-2.5 md:p-5 pt-6! pb-0! text-center">
        <h3 class="mb-2 font-medium leading-[1.1] text-admin-heading text-[1.625rem]">Print Data Inventaris PPGT JSK</h3>
    </div>
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-slate-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('inventaris.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-slate-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-slate-500 text-2xl text-white shadow-lg shadow-slate-500/30"><i class="bx bx-package"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-600">Cetak / ekspor</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Data Inventaris PPGT</h1>
                </div>
            </div>
            <div class="p-6 md:p-8">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left text-[0.9375rem] [&_td]:border-b [&_td]:border-admin-border [&_td]:px-4 [&_td]:py-3 [&_td]:align-middle [&_th]:border-b [&_th]:border-admin-border [&_th]:px-4 [&_th]:py-3 [&_th]:text-xs [&_th]:font-semibold [&_th]:uppercase [&_th]:tracking-wider [&_th]:text-admin-heading [&_tbody_tr:nth-of-type(odd)]:bg-[#f9fafb]" id="print">
                        <thead>
                            <tr>
                                <th class="w-[10%]">No</th>
                                <th class="w-[20%]">Nama</th>
                                <th class="w-[10%]">Kode</th>
                                <th class="w-[10%]">Jenis Inventaris</th>
                                <th class="w-[10%]">Jumlah</th>
                                <th class="w-[10%]">Keterangan</th>
                                <th class="w-[20%]">Foto</th>
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
