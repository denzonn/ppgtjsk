@extends('layouts.admin')

@section('title')
    Periode {{ $periode->label() }}
@endsection

@section('content')
    <div class="mx-auto flex w-full max-w-5xl flex-col gap-5">
        <header class="flex items-center gap-4">
            <a href="{{ route('periode.index') }}" title="Kembali"
                class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading">
                <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">arrow_back</span>
            </a>
            <div>
                <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Data periode · hanya lihat</p>
                <h1 class="text-xl font-bold tracking-tight">Periode {{ $periode->label() }}</h1>
            </div>
        </header>

        <nav class="flex flex-wrap gap-2" aria-label="Data periode">
            @foreach ($semua as $kunci => $t)
                <a href="{{ route('periode.show', [$periode, 'tab' => $kunci]) }}" @if ($kunci === $aktif) aria-current="page" @endif
                    class="inline-flex items-center gap-1.5 rounded-lg border px-3 py-1.5 text-sm transition-colors {{ $kunci === $aktif ? 'border-admin bg-admin-light font-semibold text-admin' : 'border-admin-border bg-white font-medium text-admin-text hover:text-admin-heading' }}">
                    {{ $t[0] }}
                    <span class="rounded bg-admin-body px-1.5 font-mono text-[11px] text-admin-text">{{ $jumlah[$kunci] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="overflow-x-auto rounded-xl border border-admin-border bg-white">
            <table class="w-full text-left text-sm">
                <thead class="bg-admin-light/60 text-admin-heading">
                    <tr>
                        @foreach (array_keys($kolom) as $judul)
                            <th class="px-4 py-3">{{ $judul }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($baris as $item)
                        <tr class="border-t border-admin-border">
                            @foreach ($kolom as $judul => $nilai)
                                <td class="px-4 py-3">
                                    @if ($judul === 'Foto')
                                        <img src="{{ $nilai($item) }}" alt="" class="h-12 w-16 rounded object-cover" loading="lazy">
                                    @else
                                        {{ $nilai($item) }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($kolom) }}" class="px-4 py-10 text-center text-admin-text">Belum ada data {{ strtolower($semua[$aktif][0]) }} di periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $baris->links() }}
    </div>
@endsection
