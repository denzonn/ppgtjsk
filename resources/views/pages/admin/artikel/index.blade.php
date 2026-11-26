@extends('layouts.admin')

@section('title')
    Artikel
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Masthead koran --}}
        <header class="flex flex-col items-center gap-2 border-y-2 border-admin-heading py-4 text-center">
            <span class="font-mono text-[10px] uppercase tracking-[0.3em] text-admin">Redaksi PPGT JSK</span>
            <h1 class="font-serif text-3xl font-bold tracking-tight">Artikel</h1>
            <div class="flex flex-wrap items-center justify-center gap-2 text-xs text-admin-text">
                <span class="rounded-lg border border-admin-border bg-white px-2.5 py-1"><b class="font-mono text-admin-heading">{{ $data->count() }}</b> tulisan</span>
                <span class="rounded-lg border border-admin-border bg-white px-2.5 py-1"><b class="font-mono text-admin-heading">{{ number_format($data->sum('view_count'), 0, ',', '.') }}</b> kali dibaca</span>
                <a href="{{ route('artikel.create') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-admin px-3.5 py-2 font-semibold text-white transition-colors hover:bg-admin-dark">
                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">edit_square</span> Tulis artikel
                </a>
            </div>
        </header>

        <label class="mx-auto flex w-full max-w-md items-center gap-2 rounded-lg border border-admin-border bg-white px-3 py-2 focus-within:border-admin">
            <span class="material-symbols-outlined text-[18px]! text-admin-text" aria-hidden="true">search</span>
            <input type="search" data-filter="#artikel" placeholder="Cari judul artikel…" class="w-full bg-transparent text-sm outline-none placeholder:text-admin-text">
        </label>

        <div id="artikel" class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($data->sortByDesc('tanggal')->values() as $item)
                <article data-item
                    class="group flex flex-col overflow-hidden rounded-xl border border-admin-border bg-white transition-colors hover:border-ink-200 {{ $loop->first ? 'md:col-span-full md:flex-row' : '' }}">
                    <div class="relative overflow-hidden {{ $loop->first ? 'aspect-video md:aspect-auto md:min-h-80 md:w-1/2' : 'aspect-video' }}">
                        <span class="absolute inset-0 grid place-items-center bg-[radial-gradient(circle_at_1px_1px,#c7d2fe_1px,transparent_0)] bg-admin-light bg-size-[14px_14px] text-ink-300"><span class="material-symbols-outlined text-[40px]!" aria-hidden="true">article</span></span>
                        <img src="{{ $item->photo }}" alt="" onerror="this.hidden=true" class="absolute inset-0 size-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @if ($loop->first)
                            <span class="absolute left-3 top-3 rounded-full bg-admin px-2.5 py-0.5 text-[11px] font-semibold text-white">Terbaru</span>
                        @endif
                    </div>
                    <div class="flex flex-1 flex-col gap-2 p-5">
                        <p class="flex items-center gap-2 font-mono text-[11px] text-admin-text">
                            {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('D MMM YYYY') : '' }}
                            <span class="inline-flex items-center gap-0.5 text-bronze-500"><span class="material-symbols-outlined text-[13px]!" aria-hidden="true">visibility</span>{{ $item->view_count ?? 0 }}</span>
                        </p>
                        <h2 class="font-serif font-bold leading-snug {{ $loop->first ? 'text-xl md:text-2xl' : 'text-lg' }}">{{ $item->judul }}</h2>
                        <p class="{{ $loop->first ? 'line-clamp-5' : 'line-clamp-3' }} text-sm text-admin-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 200) }}</p>
                        <div class="mt-auto flex items-center gap-1 border-t border-admin-border pt-3">
                            <span class="flex-1 truncate text-xs text-admin-text">oleh <b class="text-admin-heading">{{ $item->penulis ?: '—' }}</b></span>
                            <a href="{{ route('artikel.edit', $item->id) }}" title="Ubah"
                                class="flex size-8 items-center justify-center rounded-lg text-admin-text hover:bg-admin-body hover:text-admin-heading">
                                <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">edit</span></a>
                            <form action="{{ route('artikel.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                    class="flex size-8 items-center justify-center rounded-lg text-admin-text hover:bg-danger-50 hover:text-danger-600">
                                    <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">delete</span></button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <p class="col-span-full rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada artikel.</p>
            @endforelse
        </div>
    </div>
@endsection
