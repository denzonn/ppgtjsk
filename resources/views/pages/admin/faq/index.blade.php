@extends('layouts.admin')

@section('title')
    FAQ
@endsection

@section('content')
    <div class="grid gap-5 lg:grid-cols-[300px_1fr]">
        {{-- Panel kiri: identitas halaman --}}
        <aside class="flex flex-col gap-3 lg:sticky lg:top-20 lg:self-start">
            <div class="relative overflow-hidden rounded-xl bg-admin p-5 text-white">
                <span class="pointer-events-none absolute -right-3 -top-8 select-none text-[9rem] font-bold leading-none text-white/10">?</span>
                <span class="font-mono text-[10px] uppercase tracking-wider text-ink-200">Beranda</span>
                <h1 class="mt-1 text-xl font-bold tracking-tight">Tanya Jawab</h1>
                <p class="mt-1 text-sm text-ink-100">Pertanyaan yang sering diajukan pengunjung, tampil di bagian FAQ beranda.</p>
                <p class="mt-5 flex items-baseline gap-1.5"><span class="text-3xl font-bold tabular-nums">{{ $faq->count() }}</span><span class="text-xs text-ink-200">pertanyaan</span></p>
            </div>
            <a href="{{ route('faq.create') }}"
                class="flex items-center justify-center gap-1.5 rounded-xl border border-dashed border-ink-300 bg-white py-3 text-xs font-semibold text-admin transition-colors hover:border-admin hover:bg-admin-light">
                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">add</span> Tambah FAQ
            </a>
        </aside>

        {{-- Daftar accordion --}}
        <section class="flex flex-col gap-3">
            <label class="flex items-center gap-2 rounded-xl border border-admin-border bg-white px-4 py-2.5 focus-within:border-admin">
                <span class="material-symbols-outlined text-[18px]! text-admin-text" aria-hidden="true">search</span>
                <input type="search" data-filter="#faq-list" placeholder="Cari pertanyaan…" class="w-full bg-transparent text-sm outline-none placeholder:text-admin-text">
            </label>
            <div id="faq-list" class="flex flex-col gap-2">
                @forelse ($faq as $item)
                    <details data-item class="group rounded-xl border border-admin-border bg-white open:border-admin">
                        <summary class="flex cursor-pointer list-none items-center gap-3 px-4 py-3.5 [&::-webkit-details-marker]:hidden">
                            <span class="grid size-8 shrink-0 place-items-center rounded-lg bg-admin-body font-mono text-xs font-semibold text-admin-text group-open:bg-admin group-open:text-white">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="flex-1 text-sm font-semibold">{{ $item->pertanyaan }}</span>
                            <span class="material-symbols-outlined text-[18px]! text-admin-text transition-transform group-open:rotate-180" aria-hidden="true">expand_more</span>
                        </summary>
                        <div class="border-t border-admin-border px-4 pb-4 pt-3 sm:pl-[3.75rem]">
                            <div class="rich-text text-sm text-admin-text">{!! $item->jawaban !!}</div>
                            <div class="mt-3 flex gap-2">
                                <a href="{{ route('faq.edit', $item->id) }}"
                                    class="inline-flex items-center gap-1 rounded-lg border border-admin-border px-3 py-1.5 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-body">
                                    <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">edit</span> Ubah
                                </a>
                                <form action="{{ route('faq.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-xs font-semibold text-danger-600 transition-colors hover:bg-danger-50">
                                        <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">delete</span> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </details>
                @empty
                    <p class="rounded-xl border border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada FAQ.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
