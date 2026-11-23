@extends('layouts.admin')

@section('title')
    Kegiatan Mingguan
@endsection

@section('content')
    {{-- Header: strip minggu berjalan --}}
    <header class="mb-8 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-admin-border md:p-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-admin-heading md:text-3xl">Agenda Mingguan</h1>
                <p class="text-slate-500">Jadwal yang tampil di tabel "Kegiatan Seminggu" beranda.</p>
            </div>
            <a href="{{ route('kegiatan-mingguan.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-orange-500 px-5 py-3 font-semibold text-white shadow-lg shadow-orange-500/30 transition hover:bg-orange-600">
                <i class="bx bx-calendar-plus text-xl"></i> Tambah Agenda
            </a>
        </div>
        <div class="mt-6 grid grid-cols-7 gap-2 text-center">
            @foreach (range(0, 6) as $d)
                @php($day = now()->startOfWeek()->addDays($d))
                <div class="rounded-2xl py-3 {{ $day->isToday() ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'bg-orange-50 text-orange-900' }}">
                    <p class="text-[0.65rem] font-bold uppercase tracking-wider opacity-70">{{ $day->locale('id')->isoFormat('ddd') }}</p>
                    <p class="text-xl font-extrabold">{{ $day->day }}</p>
                </div>
            @endforeach
        </div>
    </header>

    {{-- Agenda per tanggal --}}
    <div class="relative space-y-8 before:absolute before:bottom-0 before:left-[2.2rem] before:top-0 before:w-0.5 before:bg-orange-200 max-sm:before:hidden">
        @forelse ($kegiatan->groupBy('tanggal') as $tanggal => $items)
            @php($date = \Carbon\Carbon::parse($tanggal)->locale('id'))
            <section class="relative flex gap-6">
                <div class="z-10 w-[4.4rem] shrink-0 overflow-hidden rounded-2xl bg-white text-center shadow-md ring-1 ring-orange-200 max-sm:hidden">
                    <p class="bg-orange-500 py-1 text-[0.65rem] font-bold uppercase tracking-wider text-white">{{ $date->isoFormat('MMM') }}</p>
                    <p class="py-1 text-2xl font-black text-admin-heading">{{ $date->day }}</p>
                    <p class="pb-1.5 text-[0.65rem] font-semibold text-slate-400">{{ $date->isoFormat('dddd') }}</p>
                </div>
                <div class="flex-1 space-y-3">
                    <p class="text-sm font-semibold text-orange-600 sm:hidden">{{ $date->isoFormat('dddd, D MMMM YYYY') }}</p>
                    @foreach ($items as $item)
                        <article class="flex flex-wrap items-center gap-4 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-admin-border transition hover:ring-orange-300">
                            <span class="rounded-xl bg-orange-100 px-3 py-2 font-mono text-sm font-bold text-orange-700">
                                {{ \Illuminate\Support\Str::of($item->waktu)->limit(5, '') }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <h3 class="font-bold text-admin-heading">{{ $item->kegiatan->name }}</h3>
                                <p class="flex items-center gap-1 text-sm text-slate-500"><i class="bx bx-map text-orange-500"></i>
                                    <span class="rich-text">{!! $item->tempat !!}</span></p>
                            </div>
                            <div class="flex gap-1">
                                <a href="{{ route('kegiatan-mingguan.edit', $item->id) }}" title="Ubah"
                                    class="grid size-9 place-items-center rounded-xl text-slate-500 transition hover:bg-orange-50 hover:text-orange-600"><i class="bx bx-edit-alt text-lg"></i></a>
                                <form action="{{ route('kegiatan-mingguan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="grid size-9 place-items-center rounded-xl text-slate-500 transition hover:bg-rose-50 hover:text-rose-600"><i class="bx bx-trash text-lg"></i></button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @empty
            <p class="rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada agenda.</p>
        @endforelse
    </div>
@endsection
