@extends('layouts.admin')

@section('title')
    Artikel
@endsection

@section('content')
    {{-- Header: masthead koran --}}
    <header class="mb-8 border-y-2 border-admin-heading py-5 text-center">
        <p class="text-xs font-bold uppercase tracking-[0.35em] text-fuchsia-600">Redaksi PPGT JSK</p>
        <h1 class="font-serif text-4xl font-black text-admin-heading md:text-5xl">Artikel</h1>
        <div class="mt-3 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-slate-500">
            <span>{{ $data->count() }} tulisan</span>
            <span>{{ number_format($data->sum('view_count'), 0, ',', '.') }} kali dibaca</span>
            <a href="{{ route('artikel.create') }}" class="inline-flex items-center gap-1 rounded-full bg-fuchsia-600 px-4 py-1.5 font-semibold text-white hover:bg-fuchsia-700">
                <i class="bx bx-pen"></i> Tulis artikel
            </a>
        </div>
    </header>

    <label class="mx-auto mb-8 flex max-w-lg items-center gap-3 rounded-full bg-white px-5 py-3 shadow-sm ring-1 ring-admin-border focus-within:ring-2 focus-within:ring-fuchsia-400">
        <i class="bx bx-search text-xl text-slate-400"></i>
        <input type="search" data-filter="#artikel" placeholder="Cari judul artikel…" class="w-full bg-transparent outline-none">
    </label>

    <div id="artikel" class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($data->sortByDesc('tanggal')->values() as $item)
            <article data-item
                class="group flex flex-col overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border transition hover:shadow-xl hover:shadow-fuchsia-100 {{ $loop->first ? 'md:col-span-2 md:flex-row' : '' }}">
                <div class="relative overflow-hidden {{ $loop->first ? 'aspect-video md:aspect-auto md:w-3/5' : 'aspect-video' }}">
                    <img src="{{ $item->photo }}" alt="" class="absolute inset-0 size-full object-cover transition duration-500 group-hover:scale-105">
                    @if ($loop->first)
                        <span class="absolute left-4 top-4 rounded-full bg-fuchsia-600 px-3 py-1 text-xs font-bold uppercase tracking-wider text-white">Terbaru</span>
                    @endif
                </div>
                <div class="flex flex-1 flex-col p-6">
                    <p class="text-xs font-semibold uppercase tracking-wider text-fuchsia-600">
                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('D MMM YYYY') : '' }}
                        <span class="text-slate-300">·</span> <i class="bx bx-show"></i> {{ $item->view_count ?? 0 }}
                    </p>
                    <h2 class="mt-2 font-serif font-bold text-admin-heading {{ $loop->first ? 'text-2xl md:text-3xl' : 'text-xl' }}">{{ $item->judul }}</h2>
                    <p class="mt-2 line-clamp-3 text-sm text-slate-500">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 200) }}</p>
                    <div class="mt-auto flex items-center gap-2 pt-5">
                        <span class="flex-1 truncate text-sm text-slate-400">oleh {{ $item->penulis ?: '—' }}</span>
                        <a href="{{ route('artikel.edit', $item->id) }}" title="Ubah"
                            class="grid size-9 place-items-center rounded-full bg-fuchsia-50 text-fuchsia-600 hover:bg-fuchsia-600 hover:text-white"><i class="bx bx-edit-alt"></i></a>
                        <form action="{{ route('artikel.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="grid size-9 place-items-center rounded-full bg-slate-50 text-slate-500 hover:bg-rose-600 hover:text-white"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <p class="col-span-full rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada artikel.</p>
        @endforelse
    </div>
@endsection
