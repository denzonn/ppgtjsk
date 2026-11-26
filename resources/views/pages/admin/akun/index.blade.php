@extends('layouts.admin')

@section('title')
    Akun Admin
@endsection

@section('content')
    <div class="mx-auto flex w-full max-w-4xl flex-col gap-5">
        <header class="flex items-center justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold tracking-tight">Akun Admin</h1>
                <p class="text-sm text-admin-text">Akun pengelola per periode kepengurusan.</p>
            </div>
            <a href="{{ route('akun.create') }}" class="rounded-lg bg-admin px-4 py-2 text-sm font-semibold text-white hover:bg-admin-dark">Tambah Akun</a>
        </header>
        @if (session('success'))
            <div class="rounded-xl p-4 bg-success-50 text-success-700">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="rounded-xl p-4 bg-danger-50 text-danger-700">{{ session('error') }}</div>
        @endif
        @forelse ($akun as $periodeId => $daftar)
            <div class="overflow-x-auto rounded-xl border border-admin-border bg-white">
                <p class="border-b border-admin-border bg-admin-light/60 px-4 py-3 font-bold text-admin-heading">Periode {{ $periode[$periodeId]->label() }}</p>
                <table class="w-full text-left text-sm">
                    <tbody>
                        @foreach ($daftar as $a)
                            <tr class="border-t border-admin-border first:border-t-0">
                                <td class="px-4 py-3 font-semibold">{{ $a->name }}</td>
                                <td class="px-4 py-3">{{ $a->email }}</td>
                                <td class="px-4 py-3 text-right">
                                    <form action="{{ route('akun.destroy', $a->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="text-sm font-semibold text-danger-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div class="rounded-xl border border-admin-border bg-white p-5 text-sm text-admin-text">Belum ada akun.</div>
        @endforelse
    </div>
@endsection
