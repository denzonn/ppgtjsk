@extends('layouts.admin')

@section('title')
    Admin Data Anggota
@endsection

@section('content')
    <div class="pages pt-4 pb-0 text-center">
        <h3>Data Anggota PPGT JSK</h3>
    </div>
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('data-anggota.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Data Anggota</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="print">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Goldar</th>
                                <th>Rhesus</th>
                                <th>Bersedia</th>
                                <th>Status</th>
                                <th>Keanggotaan</th>
                                <th>LKPD</th>
                                <th>LKPL</th>
                                <th>LKPA</th>
                                <th>TOT</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>
                                <th>Domisili</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Keterangan Tinggal</th>
                                <th>Wilayah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggota as $item)
                                <tr>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>{{ $item->tanggal_lahir }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->golongan_darah }}</td>
                                    <td>{{ $item->rhesus }}</td>
                                    <td>{{ $item->bersedia }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->keanggotaan }}</td>
                                    <td>
                                        @foreach ($kaderisasi[$loop->index] as $kader)
                                            {{-- Cek apakah dia isinya LKPD --}}
                                            @if ($kader->pelatihan_id === 'LKPD')
                                                <!-- Tampilkan data kaderisasi -->
                                                <span>Tahun {{ $kader->tahun }}</span>
                                            @elseif ($kader->pelatihan_id === 'Belum Pernah Ikut')
                                                <span>-</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($kaderisasi[$loop->index] as $kader)
                                            {{-- Cek apakah dia isinya LKPD --}}
                                            @if ($kader->pelatihan_id === 'LKPL')
                                                <!-- Tampilkan data kaderisasi -->
                                                <span>Tahun {{ $kader->tahun }}</span>
                                            @elseif ($kader->pelatihan_id === 'Belum Pernah Ikut')
                                                <span>-</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($kaderisasi[$loop->index] as $kader)
                                            {{-- Cek apakah dia isinya LKPD --}}
                                            @if ($kader->pelatihan_id === 'LKPA')
                                                <!-- Tampilkan data kaderisasi -->
                                                <span>Tahun {{ $kader->tahun }}</span>
                                            @elseif ($kader->pelatihan_id === 'Belum Pernah Ikut')
                                                <span>-</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($kaderisasi[$loop->index] as $kader)
                                            {{-- Cek apakah dia isinya LKPD --}}
                                            @if ($kader->pelatihan_id === 'TOT')
                                                <!-- Tampilkan data kaderisasi -->
                                                <span>Tahun {{ $kader->tahun }}</span>
                                            @elseif ($kader->pelatihan_id === 'Belum Pernah Ikut')
                                                <span>-</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $item->pendidikan }}</td>
                                    <td>{{ $item->pekerjaan }}</td>
                                    <td>{{ $item->domisili }}</td>
                                    <td>{{ $item->nama_ayah }}</td>
                                    <td>{{ $item->nama_ibu }}</td>
                                    <td>{{ $item->keterangan_tinggal }}</td>
                                    <td>Kelompok {{ $item->wilayah }}</td>
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
