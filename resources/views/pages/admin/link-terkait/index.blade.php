@extends('layouts.admin')

@section('title')
    Link Terkait
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul: mirip jendela browser --}}
        <header class="overflow-hidden rounded-xl border border-admin-border bg-white">
            <div class="flex items-center gap-1.5 border-b border-admin-border bg-admin-body px-4 py-2.5">
                <span class="size-2.5 rounded-full bg-slate-300"></span><span class="size-2.5 rounded-full bg-slate-300"></span><span class="size-2.5 rounded-full bg-slate-300"></span>
                <span class="ml-3 flex flex-1 items-center gap-1.5 rounded-lg border border-admin-border bg-white px-3 py-1 font-mono text-[11px] text-admin-text">
                    <span class="material-symbols-outlined text-[13px]! text-admin" aria-hidden="true">lock</span> ppgtsatriakasih / footer / link-terkait
                </span>
            </div>
            <div class="flex flex-col justify-between gap-3 p-5 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-xl font-bold tracking-tight">Link Terkait</h1>
                    <p class="text-sm text-admin-text">Tautan yang tampil di footer situs, bagian "Link Terkait".</p>
                </div>
                <a href="{{ route('link-terkait.create') }}"
                    class="inline-flex items-center gap-1.5 self-start rounded-lg bg-admin px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-admin-dark sm:self-auto">
                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">add_link</span> Tambah Link
                </a>
            </div>
        </header>

        <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
            @forelse ($data as $item)
                @php($host = parse_url($item->link, PHP_URL_HOST) ?: $item->link)
                <article class="group flex items-center gap-3 rounded-xl border border-admin-border bg-white p-3.5 transition-colors hover:border-ink-200">
                    <span class="grid size-10 shrink-0 place-items-center rounded-lg bg-admin-light text-base font-bold uppercase text-admin">
                        {{ mb_substr(preg_replace('/^www\./', '', $host), 0, 1) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <h3 class="truncate text-sm font-bold">{{ $item->label }}</h3>
                        <a href="{{ $item->link }}" target="_blank" class="flex items-center gap-1 truncate font-mono text-[11px] text-admin-text hover:text-admin">
                            {{ $host }} <span class="material-symbols-outlined text-[12px]!" aria-hidden="true">open_in_new</span>
                        </a>
                    </div>
                    <div class="flex gap-0.5 opacity-70 transition-opacity group-hover:opacity-100">
                        <a href="{{ route('link-terkait.edit', $item->id) }}" title="Ubah"
                            class="flex size-8 items-center justify-center rounded-lg text-admin-text hover:bg-admin-body hover:text-admin-heading">
                            <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">edit</span></a>
                        <form action="{{ route('link-terkait.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="flex size-8 items-center justify-center rounded-lg text-admin-text hover:bg-danger-50 hover:text-danger-600">
                                <span class="material-symbols-outlined text-[17px]!" aria-hidden="true">delete</span></button>
                        </form>
                    </div>
                </article>
            @empty
                <p class="col-span-full rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada link.</p>
            @endforelse
        </div>
    </div>
@endsection
