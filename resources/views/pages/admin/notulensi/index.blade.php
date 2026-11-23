@extends('layouts.admin')

@section('title')
    Notulensi Rapat
@endsection

@section('content')
    <div class="grid gap-8 xl:grid-cols-[1fr_300px]">
        <section class="order-2 xl:order-1">
            <label class="mb-6 flex items-center gap-3 border-b-2 border-slate-300 pb-2 focus-within:border-blue-500">
                <i class="bx bx-search text-xl text-slate-400"></i>
                <input type="search" data-filter="#notula" placeholder="Cari judul atau isi rapat…" class="w-full bg-transparent text-lg outline-none">
            </label>
            {{-- Kertas bergaris --}}
            <div id="notula" class="space-y-4">
                @forelse ($notulensi->sortByDesc('tanggal') as $item)
                    @php($date = \Carbon\Carbon::parse($item->tanggal)->locale('id'))
                    <article data-item
                        class="relative flex gap-5 rounded-r-2xl border-l-[6px] border-blue-500 bg-white bg-[linear-gradient(transparent_31px,#e2e8f0_32px)] bg-[length:100%_32px] p-5 shadow-sm">
                        <div class="w-16 shrink-0 text-center">
                            <p class="text-3xl font-black leading-none text-blue-600">{{ $date->day }}</p>
                            <p class="text-xs font-bold uppercase text-slate-400">{{ $date->isoFormat('MMM YY') }}</p>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h2 class="text-lg font-bold leading-8 text-admin-heading">{{ $item->judul }}</h2>
                            <p class="line-clamp-2 leading-8 text-slate-500">{{ strip_tags($item->isi) }}</p>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                @if ($item->file)
                                    <a href="{{ Storage::url($item->file) }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-sm font-semibold text-blue-700 hover:bg-blue-100">
                                        <i class="bx bx-paperclip"></i> Lampiran
                                    </a>
                                @endif
                                <a href="{{ route('notulensi-rapat.edit', $item->id) }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-sm font-semibold text-slate-600 hover:bg-slate-100"><i class="bx bx-edit-alt"></i> Ubah</a>
                                <form action="{{ route('notulensi-rapat.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-sm font-semibold text-rose-600 hover:bg-rose-50"><i class="bx bx-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada notulensi.</p>
                @endforelse
            </div>
        </section>

        {{-- Header di samping: papan klip --}}
        <aside class="order-1 xl:order-2 xl:sticky xl:top-24 xl:self-start">
            <div class="relative rounded-3xl bg-blue-600 p-6 pt-10 text-white shadow-xl shadow-blue-600/30">
                <span class="absolute -top-3 left-1/2 h-7 w-24 -translate-x-1/2 rounded-lg bg-slate-300 shadow-inner ring-4 ring-slate-200"></span>
                <h1 class="text-2xl font-extrabold">Notulensi Rapat</h1>
                <p class="mt-1 text-sm text-blue-100">Catatan hasil rapat pengurus, lengkap dengan lampirannya.</p>
                <p class="mt-6 text-sm text-blue-100">Rapat terakhir</p>
                <p class="text-lg font-bold">
                    {{ $notulensi->max('tanggal') ? \Carbon\Carbon::parse($notulensi->max('tanggal'))->locale('id')->isoFormat('D MMMM YYYY') : '—' }}
                </p>
                <a href="{{ route('notulensi-rapat.create') }}"
                    class="mt-6 flex items-center justify-center gap-2 rounded-xl bg-white py-3 font-bold text-blue-700 transition hover:bg-blue-50">
                    <i class="bx bx-edit text-xl"></i> Tulis Notulensi
                </a>
            </div>
        </aside>
    </div>
@endsection
