@extends('layouts.admin')

@section('title')
    Periode
@endsection

@section('content')
    <div class="mx-auto flex w-full max-w-4xl flex-col gap-5">
        <header class="flex items-center justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold tracking-tight">Periode Kepengurusan</h1>
                <p class="text-sm text-admin-text">Daftar periode dan jumlah akun di dalamnya.</p>
            </div>
            @if ($bolehTambah)
                <a href="{{ route('periode.create') }}" class="rounded-lg bg-admin px-4 py-2 text-sm font-semibold text-white hover:bg-admin-dark">Tambah Periode</a>
            @endif
        </header>
        @if (session('success'))
            <div class="rounded-xl p-4 bg-success-50 text-success-700">{{ session('success') }}</div>
        @endif
        <div class="overflow-x-auto rounded-xl border border-admin-border bg-white">
            <table class="w-full text-left text-sm">
                <thead class="bg-admin-light/60 text-admin-heading">
                    <tr><th class="px-4 py-3">Periode</th><th class="px-4 py-3">Jumlah Akun</th></tr>
                </thead>
                <tbody>
                    @foreach ($periode as $p)
                        <tr class="border-t border-admin-border">
                            <td class="px-4 py-3 font-semibold">
                                @if (auth()->user()->isAdminUtama())
                                    <a href="{{ route('periode.show', $p) }}" class="text-admin hover:underline">{{ $p->label() }}</a>
                                @else
                                    {{ $p->label() }}
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $p->users_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
