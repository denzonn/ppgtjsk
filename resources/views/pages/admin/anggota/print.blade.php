@extends('layouts.admin')

@section('title')
    Admin Data Anggota
@endsection

@section('content')
    <div class="py-2.5 pl-2.5 md:p-5 pt-6! pb-0! text-center">
        <h3 class="mb-2 font-medium leading-[1.1] text-admin-heading text-[1.625rem]">Data Anggota PPGT JSK</h3>
    </div>
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-ink-50 px-6 py-5 md:px-8">
                <a href="{{ route('data-anggota.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-lg bg-white text-slate-500 border border-admin-border transition hover:text-ink-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-xl bg-ink-500 text-2xl text-white"><i class="bx bx-id-card"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-ink-600">Cetak / ekspor</p>
                    <h1 class="text-xl font-semibold text-admin-heading">Data Anggota</h1>
                </div>
            </div>
            <div class="p-6 md:p-8">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left text-[0.9375rem] [&_td]:border-b [&_td]:border-admin-border [&_td]:px-4 [&_td]:py-3 [&_td]:align-middle [&_th]:border-b [&_th]:border-admin-border [&_th]:px-4 [&_th]:py-3 [&_th]:text-xs [&_th]:font-semibold [&_th]:uppercase [&_th]:tracking-wider [&_th]:text-admin-heading [&_tbody_tr:nth-of-type(odd)]:bg-[#f9fafb]" id="print">
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
