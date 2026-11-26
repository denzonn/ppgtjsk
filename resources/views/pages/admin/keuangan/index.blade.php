@extends('layouts.admin')

@section('title')
    Data Keuangan
@endsection

@php
    $masuk = $keuangan->where('jenis', 'Masuk')->sum('jumlah');
    $keluar = $keuangan->where('jenis', 'Keluar')->sum('jumlah');
    $rp = fn($n) => 'Rp ' . number_format($n, 0, ',', '.');
@endphp

@section('content')
    {{-- Header: kartu saldo besar --}}
    <section class="mb-8 grid gap-6 lg:grid-cols-[1.3fr_1fr]">
        <div class="relative overflow-hidden rounded-xl bg-admin-ink p-8 text-white">
            <span class="absolute -right-10 -top-10 size-48 rounded-full border-[24px] border-white/10"></span>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-ink-200">Saldo Kas PPGT</p>
            <p class="mt-2 text-4xl font-semibold tracking-tight md:text-4xl">{{ $rp($masuk - $keluar) }}</p>
            <div class="mt-8 grid grid-cols-2 gap-4 text-sm">
                <div class="rounded-xl bg-white/10 p-4">
                    <p class="flex items-center gap-1 text-ink-200"><i class="bx bx-down-arrow-alt text-lg"></i> Total masuk</p>
                    <p class="text-lg font-bold">{{ $rp($masuk) }}</p>
                </div>
                <div class="rounded-xl bg-white/10 p-4">
                    <p class="flex items-center gap-1 text-ink-200"><i class="bx bx-up-arrow-alt text-lg"></i> Total keluar</p>
                    <p class="text-lg font-bold">{{ $rp($keluar) }}</p>
                </div>
            </div>
        </div>
        <nav class="grid gap-3">
            @foreach ([['pemasukan.index', 'Pemasukan', 'bx-trending-up', 'bg-success-100 text-success-700', $rp($masuk)], ['pengeluaran.index', 'Pengeluaran', 'bx-trending-down', 'bg-danger-100 text-danger-700', $rp($keluar)], ['piutang.index', 'Piutang', 'bx-time-five', 'bg-bronze-100 text-bronze-700', $rp($piutang) . ' belum lunas']] as [$route, $label, $icon, $tone, $value])
                <a href="{{ route($route) }}" class="group flex items-center gap-4 rounded-xl bg-white p-4 border border-admin-border transition hover:-translate-y-0.5">
                    <span class="grid size-12 place-items-center rounded-lg text-2xl {{ $tone }}"><i class="bx {{ $icon }}"></i></span>
                    <span class="flex-1">
                        <span class="block font-bold text-admin-heading">{{ $label }}</span>
                        <span class="block text-sm text-slate-500">{{ $value }}</span>
                    </span>
                    <i class="bx bx-chevron-right text-2xl text-slate-300 transition group-hover:translate-x-1 group-hover:text-slate-500"></i>
                </a>
            @endforeach
        </nav>
    </section>

    {{-- Laporan --}}
    <section class="rounded-xl bg-white p-6 border border-admin-border">
        <h2 class="mb-4 flex items-center gap-2 text-lg font-bold text-admin-heading"><i class="bx bx-receipt text-success-600"></i> Laporan Keuangan PPGT</h2>
        <div class="overflow-x-auto">
            <table id="print" class="w-full text-left text-sm [&_td]:border-b [&_td]:border-dashed [&_td]:border-admin-border [&_td]:px-3 [&_td]:py-3 [&_th]:px-3 [&_th]:py-3 [&_th]:text-xs [&_th]:font-bold [&_th]:uppercase [&_th]:tracking-wider [&_th]:text-slate-400">
                <thead>
                    <tr>
                        <th class="w-[8%]">No</th>
                        <th class="w-[27%]">Tanggal Masuk/Keluar</th>
                        <th>Keterangan</th>
                        <th class="w-[10%]">Jenis</th>
                        <th class="w-[18%] text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keuangan as $index => $item)
                        <tr>
                            <td class="text-slate-400">{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                            <td class="font-medium text-admin-heading">{{ $item->keterangan }}</td>
                            <td>
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $item->jenis === 'Masuk' ? 'bg-success-100 text-success-700' : 'bg-danger-100 text-danger-700' }}">{{ $item->jenis }}</span>
                            </td>
                            <td class="text-right font-mono font-semibold {{ $item->jenis === 'Masuk' ? 'text-success-600' : 'text-danger-600' }}">
                                {{ $item->jenis === 'Masuk' ? '+' : '−' }} Rp. {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
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
