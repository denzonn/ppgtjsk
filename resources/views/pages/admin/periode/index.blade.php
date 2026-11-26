@extends('layouts.admin')

@section('title')
    Periode
@endsection

@section('content')
    @php
        $utama = auth()->user()->isAdminUtama();
        $tahun = now()->year;
    @endphp
    <div class="mx-auto flex w-full max-w-5xl flex-col gap-6">
        <header class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="grid size-10 place-items-center rounded-full bg-admin-light text-admin ring-1 ring-admin/15">
                    <span class="material-symbols-outlined text-[20px]! [font-variation-settings:'FILL'_1]" aria-hidden="true">calendar_month</span>
                </span>
                <div>
                    <h1 class="text-xl font-bold tracking-tight">Periode Kepengurusan</h1>
                    <p class="text-sm text-admin-text">
                        {{ $utama ? 'Pilih periode untuk melihat datanya.' : 'Daftar periode kepengurusan PPGT Satria Kasih.' }}
                    </p>
                </div>
            </div>
            @if ($bolehTambah)
                <a href="{{ route('periode.create') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-admin px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-admin-dark">
                    <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">add</span> Tambah Periode
                </a>
            @endif
        </header>

        @if (session('success'))
            <div class="flex items-center gap-2 rounded-xl bg-success-50 p-4 text-sm text-success-700 ring-1 ring-success-200">
                <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">check_circle</span>{{ session('success') }}
            </div>
        @endif

        @if ($periode->isEmpty())
            <div class="rounded-xl border border-dashed border-admin-border bg-white p-10 text-center text-sm text-admin-text">Belum ada periode.</div>
        @else
            <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($periode as $p)
                    @php
                        [$status, $warna] = $p->isAktif()
                            ? ['Aktif', 'bg-success-50 text-success-700 ring-success-200']
                            : ($p->tahun_mulai > $tahun ? ['Akan datang', 'bg-admin-light text-admin ring-admin/20'] : ['Selesai', 'bg-slate-100 text-slate-600 ring-slate-200']);
                        $milikSaya = auth()->user()->periode_id === $p->id;
                    @endphp
                    <li class="group flex flex-col rounded-xl border bg-white transition-shadow hover:shadow-sm {{ $milikSaya ? 'border-admin ring-1 ring-admin/20' : 'border-admin-border' }}">
                        <div class="flex items-start justify-between gap-3 p-5">
                            <div>
                                <p class="font-mono text-[10px] uppercase tracking-wider text-admin-text">Periode</p>
                                <p class="mt-0.5 text-2xl font-bold tracking-tight text-admin-heading tabular-nums">
                                    {{ $p->tahun_mulai }}<span class="px-1 text-admin-text">–</span>{{ $p->tahun_selesai }}
                                </p>
                            </div>
                            <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 {{ $warna }}">{{ $status }}</span>
                        </div>

                        <dl class="grid grid-cols-2 gap-px border-y border-admin-border bg-admin-border text-sm">
                            <div class="bg-white px-5 py-3">
                                <dt class="text-xs text-admin-text">Akun</dt>
                                <dd class="font-semibold tabular-nums">{{ $p->users_count }}</dd>
                            </div>
                            <div class="bg-white px-5 py-3">
                                <dt class="text-xs text-admin-text">Pengurus</dt>
                                <dd class="font-semibold tabular-nums">{{ $pengurus[$p->id] ?? 0 }}</dd>
                            </div>
                        </dl>

                        <div class="mt-auto flex items-center justify-between gap-2 px-5 py-3">
                            @if ($milikSaya)
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-admin">
                                    <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">person_pin</span> Periode Anda
                                </span>
                            @else
                                <span></span>
                            @endif
                            @if ($utama)
                                <a href="{{ route('periode.show', $p) }}"
                                    class="inline-flex items-center gap-1 rounded-lg border border-admin-border px-3 py-1.5 text-xs font-semibold text-admin-heading transition-colors hover:border-admin hover:bg-admin-light hover:text-admin">
                                    Lihat data <span class="material-symbols-outlined text-[16px]! transition-transform group-hover:translate-x-0.5" aria-hidden="true">arrow_forward</span>
                                </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
