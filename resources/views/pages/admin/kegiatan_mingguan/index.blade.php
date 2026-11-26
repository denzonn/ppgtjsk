@extends('layouts.admin')

@section('title')
    Kegiatan Mingguan
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul + strip minggu berjalan --}}
        <header class="flex flex-col gap-4 rounded-xl border border-admin-border bg-white p-5">
            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-xl font-bold tracking-tight">Agenda Mingguan</h1>
                    <p class="text-sm text-admin-text">Jadwal yang tampil di tabel "Kegiatan Seminggu" beranda.</p>
                </div>
                <a href="{{ route('kegiatan-mingguan.create') }}"
                    class="inline-flex items-center gap-1.5 self-start rounded-lg bg-admin px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-admin-dark sm:self-auto">
                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">calendar_add_on</span> Tambah Agenda
                </a>
            </div>
            @php($dates = $kegiatan->pluck('tanggal')->map(fn($t) => \Carbon\Carbon::parse($t)->toDateString())->unique())
            <div class="grid grid-cols-7 gap-1.5 text-center">
                @foreach (range(0, 6) as $d)
                    @php($day = now()->startOfWeek()->addDays($d))
                    <div class="relative rounded-lg py-2 {{ $day->isToday() ? 'bg-admin text-white' : 'bg-admin-body text-admin-heading' }}">
                        <p class="text-[10px] font-semibold uppercase tracking-wider opacity-70">{{ $day->locale('id')->isoFormat('ddd') }}</p>
                        <p class="text-lg font-bold tabular-nums">{{ $day->day }}</p>
                        @if ($dates->contains($day->toDateString()))
                            <span class="absolute bottom-1 left-1/2 size-1.5 -translate-x-1/2 rounded-full {{ $day->isToday() ? 'bg-white' : 'bg-bronze-400' }}"></span>
                        @endif
                    </div>
                @endforeach
            </div>
        </header>

        {{-- Agenda per tanggal --}}
        <div class="relative flex flex-col gap-5 before:absolute before:bottom-0 before:left-[1.95rem] before:top-0 before:w-px before:bg-admin-border max-sm:before:hidden">
            @forelse ($kegiatan->groupBy('tanggal') as $tanggal => $items)
                @php($date = \Carbon\Carbon::parse($tanggal)->locale('id'))
                <section class="relative flex gap-4">
                    <div class="z-10 w-16 shrink-0 overflow-hidden rounded-xl border border-admin-border bg-white text-center max-sm:hidden">
                        <p class="py-0.5 text-[10px] font-semibold uppercase tracking-wider {{ $date->isToday() ? 'bg-admin text-white' : 'bg-admin-light text-admin' }}">{{ $date->isoFormat('MMM') }}</p>
                        <p class="text-xl font-bold tabular-nums">{{ $date->day }}</p>
                        <p class="pb-1 text-[10px] text-admin-text">{{ $date->isoFormat('dddd') }}</p>
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <p class="text-xs font-semibold text-admin sm:hidden">{{ $date->isoFormat('dddd, D MMMM YYYY') }}</p>
                        @foreach ($items as $item)
                            <article class="flex flex-wrap items-center gap-3 rounded-xl border border-admin-border bg-white p-3.5 transition-colors hover:border-ink-200">
                                <span class="rounded-full bg-bronze-50 px-2.5 py-1 font-mono text-xs font-medium text-bronze-600 ring-1 ring-bronze-200">
                                    {{ \Illuminate\Support\Str::of($item->waktu)->limit(5, '') }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-sm font-bold">{{ $item->kegiatan->name }}</h3>
                                    <p class="flex items-center gap-1 text-xs text-admin-text">
                                        <span class="material-symbols-outlined text-[14px]!" aria-hidden="true">location_on</span>
                                        <span class="rich-text">{!! $item->tempat !!}</span>
                                    </p>
                                </div>
                                <div class="flex gap-1">
                                    <a href="{{ route('kegiatan-mingguan.edit', $item->id) }}" title="Ubah"
                                        class="flex size-8 items-center justify-center rounded-lg text-admin-text transition-colors hover:bg-admin-body hover:text-admin-heading">
                                        <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">edit</span></a>
                                    <form action="{{ route('kegiatan-mingguan.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                            class="flex size-8 items-center justify-center rounded-lg text-admin-text transition-colors hover:bg-danger-50 hover:text-danger-600">
                                            <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">delete</span></button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @empty
                <p class="rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada agenda.</p>
            @endforelse
        </div>
    </div>
@endsection
