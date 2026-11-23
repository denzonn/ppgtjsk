@extends('layouts.admin')

@section('title')
    FAQ
@endsection

@section('content')
    <div class="grid gap-8 lg:grid-cols-[320px_1fr]">
        {{-- Panel kiri: identitas halaman --}}
        <aside class="lg:sticky lg:top-24 lg:self-start">
            <div class="relative overflow-hidden rounded-3xl bg-sky-500 p-7 text-white shadow-xl shadow-sky-500/25">
                <span class="pointer-events-none absolute -right-4 -top-10 select-none text-[11rem] font-black leading-none text-white/15">?</span>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-sky-100">Beranda</p>
                <h1 class="mt-1 text-3xl font-extrabold">Tanya Jawab</h1>
                <p class="mt-2 text-sm text-sky-50">Pertanyaan yang sering diajukan pengunjung, tampil di bagian FAQ beranda.</p>
                <p class="mt-6 text-5xl font-black">{{ $faq->count() }}<span class="ml-2 text-base font-medium text-sky-100">pertanyaan</span></p>
            </div>
            <a href="{{ route('faq.create') }}"
                class="mt-4 flex items-center justify-center gap-2 rounded-2xl border-2 border-dashed border-sky-300 bg-sky-50 py-4 font-semibold text-sky-700 transition hover:border-sky-500 hover:bg-sky-100">
                <i class="bx bx-plus-circle text-xl"></i> Tambah FAQ
            </a>
        </aside>

        {{-- Daftar accordion --}}
        <section>
            <label class="mb-4 flex items-center gap-3 rounded-2xl bg-white px-4 py-3 shadow-sm ring-1 ring-admin-border focus-within:ring-2 focus-within:ring-sky-400">
                <i class="bx bx-search text-xl text-slate-400"></i>
                <input type="search" data-filter="#faq-list" placeholder="Cari pertanyaan…" class="w-full bg-transparent outline-none">
            </label>
            <div id="faq-list" class="space-y-3">
                @forelse ($faq as $item)
                    <details data-item class="group rounded-2xl bg-white shadow-sm ring-1 ring-admin-border open:ring-2 open:ring-sky-400">
                        <summary class="flex cursor-pointer list-none items-center gap-4 p-5 [&::-webkit-details-marker]:hidden">
                            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-sky-100 font-bold text-sky-700 group-open:bg-sky-500 group-open:text-white">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="flex-1 font-semibold text-admin-heading">{{ $item->pertanyaan }}</span>
                            <i class="bx bx-chevron-down text-2xl text-slate-400 transition group-open:rotate-180"></i>
                        </summary>
                        <div class="border-t border-dashed border-admin-border px-5 pb-5 pt-4 sm:pl-[4.75rem]">
                            <div class="rich-text text-slate-600">{!! $item->jawaban !!}</div>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('faq.edit', $item->id) }}"
                                    class="inline-flex items-center gap-1.5 rounded-xl bg-sky-50 px-3 py-2 text-sm font-semibold text-sky-700 transition hover:bg-sky-100">
                                    <i class="bx bx-edit-alt"></i> Ubah
                                </a>
                                <form action="{{ route('faq.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="inline-flex items-center gap-1.5 rounded-xl px-3 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-50">
                                        <i class="bx bx-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </details>
                @empty
                    <p class="rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada FAQ.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
