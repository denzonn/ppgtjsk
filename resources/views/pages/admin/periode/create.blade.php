@extends('layouts.admin')

@section('title')
    Tambah Periode
@endsection

@section('content')
    @php
        $in = 'block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] tabular-nums text-admin-heading outline-none transition focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light read-only:cursor-not-allowed read-only:bg-slate-100 read-only:text-admin-text';
        $lb = 'mb-2 inline-block text-sm font-semibold text-admin-heading';
    @endphp
    <div class="mx-auto w-full max-w-xl">
        <div class="overflow-hidden rounded-xl border border-admin-border bg-white">
            <div class="flex items-center gap-4 border-b border-admin-border bg-admin-light/60 px-5 py-4 md:px-6">
                <a href="{{ route('periode.index') }}" title="Kembali"
                    class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading">
                    <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">arrow_back</span>
                </a>
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Tambah data</p>
                    <h1 class="text-base font-bold text-admin-heading">Tambah Periode</h1>
                </div>
            </div>

            <form action="{{ route('periode.store') }}" method="POST" class="flex flex-col gap-6 p-5 md:p-6">
                @csrf
                @if ($errors->any())
                    <div class="rounded-xl bg-danger-50 p-4 text-sm text-danger-700 ring-1 ring-danger-200 [&_ul]:list-disc [&_ul]:pl-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-[1fr_auto_1fr] items-end gap-3">
                    <div>
                        <label for="tahun_mulai" class="{{ $lb }}">Tahun Mulai <span class="font-bold text-danger-500">*</span></label>
                        <input type="number" name="tahun_mulai" id="tahun_mulai" min="2000" max="2100" placeholder="2026"
                            value="{{ old('tahun_mulai', $mulai) }}" @readonly($mulai) class="{{ $in }}">
                    </div>
                    <span class="pb-2.5 text-lg font-semibold text-admin-text" aria-hidden="true">–</span>
                    <div>
                        <label for="tahun_selesai" class="{{ $lb }}">Tahun Selesai <span class="font-bold text-danger-500">*</span></label>
                        <input type="number" name="tahun_selesai" id="tahun_selesai" min="2000" max="2100" placeholder="2028"
                            value="{{ old('tahun_selesai') }}" class="{{ $in }}">
                    </div>
                </div>

                <p class="-mt-3 flex gap-2 rounded-lg bg-admin-body px-3 py-2.5 text-xs leading-5 text-admin-text">
                    <span class="material-symbols-outlined text-[16px]! text-admin" aria-hidden="true">info</span>
                    <span>
                        Akun periode hanya bisa dipakai selama tahun berjalan masih di dalam rentang ini.
                        @if ($mulai)
                            Tahun mulai mengikuti akhir periode Anda; maksimal 5 tahun.
                        @endif
                    </span>
                </p>

                <button type="submit" class="w-full rounded-lg bg-admin px-5 py-2.5 text-center text-sm font-semibold text-white transition-colors hover:bg-admin-dark">Simpan Periode</button>
            </form>
        </div>
    </div>
@endsection
