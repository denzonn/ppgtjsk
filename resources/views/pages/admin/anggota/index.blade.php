@extends('layouts.admin')

@section('title')
    Data Anggota
@endsection

@section('content')
    {{-- Header: strip statistik --}}
    <header class="mb-6 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-admin-border md:p-8">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex-1">
                <h1 class="text-2xl font-extrabold text-admin-heading md:text-3xl">Data Anggota</h1>
                <p class="text-slate-500">Anggota terdaftar PPGT Jemaat Satria Kasih.</p>
            </div>
            <a href="{{ route('data-anggota.approval') }}" class="inline-flex items-center gap-2 rounded-xl bg-sky-50 px-4 py-2.5 text-sm font-semibold text-sky-700 hover:bg-sky-100"><i class="bx bx-user-check"></i> Approval</a>
            <a href="{{ route('data-anggota.print') }}" class="inline-flex items-center gap-2 rounded-xl bg-sky-50 px-4 py-2.5 text-sm font-semibold text-sky-700 hover:bg-sky-100"><i class="bx bx-printer"></i> Cetak</a>
            <a href="{{ route('data-anggota.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-sky-600/30 hover:bg-sky-700"><i class="bx bx-user-plus"></i> Tambah Anggota</a>
        </div>
        <dl class="mt-6 grid grid-cols-2 gap-px overflow-hidden rounded-2xl bg-admin-border md:grid-cols-4">
            @foreach ([['Total', $anggota->count(), 'text-sky-600'], ['Laki-laki', $anggota->where('jenis_kelamin', 'Laki-laki')->count(), 'text-blue-600'], ['Perempuan', $anggota->where('jenis_kelamin', 'Perempuan')->count(), 'text-pink-600'], ['Bersedia donor', $anggota->where('bersedia', 'Ya')->count(), 'text-red-600']] as [$label, $value, $tone])
                <div class="bg-white p-4">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-400">{{ $label }}</dt>
                    <dd class="text-3xl font-black {{ $tone }}">{{ $value }}</dd>
                </div>
            @endforeach
        </dl>
    </header>

    <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-admin-border">
        <div class="overflow-x-auto">
            <table id="datatable" class="w-full text-left text-sm [&_td]:border-b [&_td]:border-admin-border [&_td]:px-3 [&_td]:py-3 [&_th]:bg-sky-50 [&_th]:px-3 [&_th]:py-3 [&_th]:text-xs [&_th]:font-bold [&_th]:uppercase [&_th]:tracking-wider [&_th]:text-sky-800 [&_th:first-child]:rounded-l-xl [&_th:last-child]:rounded-r-xl">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>No HP</th>
                        <th>Jenis Kelamin</th>
                        <th>Gol. Darah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggota as $item)
                        @php($female = $item->jenis_kelamin === 'Perempuan')
                        <tr class="hover:bg-sky-50/50">
                            <td>
                                <span class="flex items-center gap-3">
                                    <span class="grid size-9 shrink-0 place-items-center rounded-full text-sm font-bold text-white {{ $female ? 'bg-pink-400' : 'bg-blue-500' }}">{{ strtoupper(mb_substr($item->nama, 0, 1)) }}</span>
                                    <span class="font-semibold text-admin-heading">{{ $item->nama }}</span>
                                </span>
                            </td>
                            <td class="font-mono text-slate-500">{{ $item->nik }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $female ? 'bg-pink-50 text-pink-700' : 'bg-blue-50 text-blue-700' }}">{{ $item->jenis_kelamin }}</span></td>
                            <td><span class="inline-grid min-w-8 place-items-center rounded-lg bg-red-50 px-2 py-1 text-xs font-black text-red-600">{{ $item->golongan_darah }}</span></td>
                            <td>
                                <div class="flex justify-center gap-1">
                                    <a href="{{ route('data-anggota.edit', $item->id) }}" title="Ubah"
                                        class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-sky-100 hover:text-sky-700"><i class="bx bx-edit-alt"></i></a>
                                    <form action="{{ route('data-anggota.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                            class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-rose-100 hover:text-rose-600"><i class="bx bx-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
