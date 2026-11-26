@extends('layouts.admin')

@section('title')
    Notulensi Rapat
@endsection

@section('content')
    <div class="grid gap-5 xl:grid-cols-[1fr_280px]">
        <section class="order-2 flex flex-col gap-3 xl:order-1">
            <label class="flex items-center gap-2 rounded-lg border border-admin-border bg-white px-3 py-2 focus-within:border-admin">
                <span class="material-symbols-outlined text-[18px]! text-admin-text" aria-hidden="true">search</span>
                <input type="search" data-filter="#notula" placeholder="Cari judul atau isi rapat…" class="w-full bg-transparent text-sm outline-none placeholder:text-admin-text">
            </label>
            {{-- Kertas bergaris --}}
            <div id="notula" class="flex flex-col gap-3">
                @forelse ($notulensi->sortByDesc('tanggal') as $item)
                    @php($date = \Carbon\Carbon::parse($item->tanggal)->locale('id'))
                    <article data-item
                        class="flex gap-4 rounded-r-xl border border-l-4 border-admin-border border-l-admin bg-white bg-[linear-gradient(transparent_27px,#f1f5f9_28px)] bg-[length:100%_28px] p-4">
                        <div class="w-12 shrink-0 text-center">
                            <p class="text-2xl font-bold leading-none tabular-nums text-admin">{{ $date->day }}</p>
                            <p class="font-mono text-[10px] uppercase text-admin-text">{{ $date->isoFormat('MMM YY') }}</p>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h2 class="text-sm font-bold leading-7">{{ $item->judul }}</h2>
                            <p class="line-clamp-2 text-sm leading-7 text-admin-text">{{ strip_tags($item->isi) }}</p>
                            <div class="mt-1 flex flex-wrap items-center gap-1.5">
                                @if ($item->file)
                                    <a href="{{ $item->file }}" target="_blank"
                                        class="inline-flex items-center gap-1 rounded-lg bg-admin-light px-2.5 py-1 text-xs font-semibold text-admin hover:bg-ink-100">
                                        <span class="material-symbols-outlined text-[14px]!" aria-hidden="true">attach_file</span> Lampiran
                                    </a>
                                @endif
                                <a href="{{ route('notulensi-rapat.edit', $item->id) }}"
                                    class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1 text-xs font-semibold text-admin-heading hover:bg-admin-body">
                                    <span class="material-symbols-outlined text-[14px]!" aria-hidden="true">edit</span> Ubah</a>
                                <form action="{{ route('notulensi-rapat.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1 text-xs font-semibold text-danger-600 hover:bg-danger-50">
                                        <span class="material-symbols-outlined text-[14px]!" aria-hidden="true">delete</span> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada notulensi.</p>
                @endforelse
            </div>
        </section>

        {{-- Papan klip --}}
        <aside class="order-1 xl:sticky xl:top-20 xl:order-2 xl:self-start">
            <div class="relative flex flex-col gap-1 rounded-xl bg-admin-ink p-5 pt-8 text-white">
                <span class="absolute -top-2.5 left-1/2 h-5 w-20 -translate-x-1/2 rounded-md bg-slate-300 ring-4 ring-admin-body"></span>
                <h1 class="text-xl font-bold tracking-tight">Notulensi Rapat</h1>
                <p class="text-sm text-ink-200">Catatan hasil rapat pengurus, lengkap dengan lampirannya.</p>
                <p class="mt-4 font-mono text-[10px] uppercase tracking-wider text-ink-200">Rapat terakhir</p>
                <p class="text-sm font-semibold">
                    {{ $notulensi->max('tanggal') ? \Carbon\Carbon::parse($notulensi->max('tanggal'))->locale('id')->isoFormat('D MMMM YYYY') : '—' }}
                </p>
                <a href="{{ route('notulensi-rapat.create') }}"
                    class="mt-4 flex items-center justify-center gap-1.5 rounded-lg bg-white py-2 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-light">
                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">edit_note</span> Tulis Notulensi
                </a>
            </div>
        </aside>
    </div>
@endsection
