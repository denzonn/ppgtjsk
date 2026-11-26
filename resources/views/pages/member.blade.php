@extends('layouts.app')

@section('title')
    Keanggotaan - PPGT Jemaat Satria Kasih
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('datatable/DataTables-1.13.4/css/jquery.dataTables.css') }}">
@endpush

@section('content')
    <section class="mt-[100px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="relative mb-2 inline-block pb-[15px] text-[2rem] font-semibold after:absolute after:bottom-0 after:left-[30%] after:h-0.5 after:w-20 after:bg-ppgt-sky">
                    Iuran Anggota</h2>
            </div>
            <div class="mt-5 p-4">
                <div class="overflow-x-auto" data-aos="fade-up" data-aos-duration="2000">
                    <table id="datatable" class="w-full">
                        <thead>
                            <tr>
                                <th class="w-[10%]">No</th>
                                <th class="w-[30%]">Nama</th>
                                <th class="w-1/5">Kelompok</th>
                                <th class="w-2/5">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($iuran as $item)
                                <tr>
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
    </section>
@endsection

@push('addon-script')
    <script src="{{ asset('datatable/DataTables-1.13.4/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $('#datatable').DataTable({
            searching: true,
            searchDelay: 500,
            search: {
                smart: true
            },
        });
    </script>
@endpush
