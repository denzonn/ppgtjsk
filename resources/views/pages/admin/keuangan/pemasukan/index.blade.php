@extends('layouts.admin')

@section('title')
    Pemasukan
@endsection

@section('content')
    {{-- Header: punggung buku besar --}}
    <header class="mb-6 flex flex-wrap items-center gap-4">
        <a href="{{ route('keuangan') }}" title="Kembali ke Keuangan"
            class="grid size-11 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border hover:text-green-600"><i class="bx bx-arrow-back text-xl"></i></a>
        <div class="flex-1">
            <h1 class="flex items-center gap-2 text-2xl font-extrabold text-admin-heading"><i class="bx bx-trending-up text-green-600"></i> Buku Pemasukan</h1>
            <p class="text-sm text-slate-500">Semua dana yang masuk ke kas PPGT.</p>
        </div>
        <a href="{{ route('pemasukan.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-green-600 px-5 py-3 font-semibold text-white shadow-lg shadow-green-600/30 hover:bg-green-700">
            <i class="bx bx-plus-circle text-xl"></i> Catat Pemasukan
        </a>
    </header>

    <div class="overflow-hidden rounded-2xl border-l-[14px] border-green-700 bg-[#fbfdf7] shadow-md ring-1 ring-green-200">
        <div class="overflow-x-auto">
            <table class="w-full font-mono text-sm [&_td]:border-b [&_td]:border-green-100 [&_td]:px-4 [&_td]:py-3 [&_th]:px-4 [&_th]:py-3">
                <thead class="bg-green-700 text-left text-xs uppercase tracking-wider text-green-50">
                    <tr>
                        <th class="w-16">No</th>
                        <th>Tanggal Masuk</th>
                        <th>Keterangan</th>
                        <th class="text-right">Jumlah</th>
                        <th class="w-28 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="[&_tr:hover]:bg-green-50">
                    @forelse ($pemasukan as $item)
                        <tr>
                            <td class="border-r-2 border-r-red-200! text-green-700/60">{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('D MMM YYYY') }}</td>
                            <td class="font-sans font-medium text-admin-heading">{{ $item->keterangan }}</td>
                            <td class="whitespace-nowrap text-right font-bold text-green-700">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <div class="flex justify-center gap-1">
                                    <a href="{{ route('pemasukan.edit', $item->id) }}" title="Ubah"
                                        class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-green-100 hover:text-green-700"><i class="bx bx-edit-alt"></i></a>
                                    <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                            class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-rose-100 hover:text-rose-600"><i class="bx bx-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-10 text-center font-sans text-slate-400">Belum ada pemasukan.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-green-50 font-bold">
                        <td colspan="3" class="border-t-4 border-double border-green-700 px-4 py-4 text-right uppercase tracking-wider text-green-800">Total</td>
                        <td class="whitespace-nowrap border-t-4 border-double border-green-700 px-4 py-4 text-right text-lg text-green-700">
                            Rp {{ number_format($pemasukan->sum('jumlah'), 0, ',', '.') }}</td>
                        <td class="border-t-4 border-double border-green-700"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
