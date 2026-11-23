@extends('layouts.admin')

@section('title')
    Link Terkait
@endsection

@section('content')
    {{-- Header: mirip address bar browser --}}
    <header class="mb-8 overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
        <div class="flex items-center gap-2 border-b border-admin-border bg-slate-50 px-5 py-3">
            <span class="size-3 rounded-full bg-rose-400"></span><span class="size-3 rounded-full bg-amber-400"></span><span class="size-3 rounded-full bg-emerald-400"></span>
            <span class="ml-4 flex flex-1 items-center gap-2 rounded-lg bg-white px-3 py-1.5 text-sm text-slate-400 ring-1 ring-admin-border">
                <i class="bx bx-lock-alt text-emerald-500"></i> ppgtsatriakasih / footer / link-terkait
            </span>
        </div>
        <div class="flex flex-wrap items-center justify-between gap-4 p-6 md:p-8">
            <div>
                <h1 class="text-2xl font-extrabold text-admin-heading md:text-3xl">Link Terkait</h1>
                <p class="text-slate-500">Tautan yang tampil di footer situs, bagian "Link Terkait".</p>
            </div>
            <a href="{{ route('link-terkait.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-cyan-500 px-5 py-3 font-semibold text-white shadow-lg shadow-cyan-500/30 transition hover:bg-cyan-600">
                <i class="bx bx-link-alt text-xl"></i> Tambah Link
            </a>
        </div>
    </header>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($data as $item)
            @php($host = parse_url($item->link, PHP_URL_HOST) ?: $item->link)
            <article class="group relative flex items-center gap-4 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-admin-border transition hover:-translate-y-0.5 hover:ring-cyan-300">
                <span class="grid size-12 shrink-0 place-items-center rounded-xl bg-linear-to-br from-cyan-400 to-blue-500 text-xl font-black uppercase text-white shadow-md shadow-cyan-500/30">
                    {{ mb_substr(preg_replace('/^www\./', '', $host), 0, 1) }}
                </span>
                <div class="min-w-0 flex-1">
                    <h3 class="truncate font-bold text-admin-heading">{{ $item->label }}</h3>
                    <a href="{{ $item->link }}" target="_blank" class="block truncate text-sm text-cyan-600 hover:underline">{{ $host }} <i class="bx bx-link-external"></i></a>
                </div>
                <div class="flex flex-col gap-1 opacity-60 transition group-hover:opacity-100">
                    <a href="{{ route('link-terkait.edit', $item->id) }}" title="Ubah"
                        class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-cyan-50 hover:text-cyan-600"><i class="bx bx-edit-alt"></i></a>
                    <form action="{{ route('link-terkait.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                            class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-rose-50 hover:text-rose-600"><i class="bx bx-trash"></i></button>
                    </form>
                </div>
            </article>
        @empty
            <p class="col-span-full rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada link.</p>
        @endforelse
    </div>
@endsection
