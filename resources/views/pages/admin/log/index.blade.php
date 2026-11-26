@extends('layouts.admin')

@section('title')
    Log Aktivitas
@endsection

@section('content')
    @php
        $fmt = fn ($v) => is_scalar($v) || $v === null ? (string) $v : json_encode($v, JSON_UNESCAPED_UNICODE);
        $select = 'rounded-lg border border-admin-border bg-white px-3 py-2 text-sm';
    @endphp
    <div class="mx-auto flex w-full max-w-6xl flex-col gap-5">
        <header>
            <h1 class="text-xl font-bold tracking-tight">Log Aktivitas</h1>
            <p class="text-sm text-admin-text">Riwayat tambah, ubah, dan hapus data.</p>
        </header>

        <form method="GET" class="flex flex-wrap gap-2">
            <select name="model" class="{{ $select }}">
                <option value="">Semua menu</option>
                @foreach (\App\Models\ActivityLog::LABEL as $class => $label)
                    <option value="{{ $class }}" @selected(request('model') === $class)>{{ $label }}</option>
                @endforeach
            </select>
            <select name="periode_id" class="{{ $select }}">
                <option value="">Semua periode</option>
                @foreach ($periodes as $p)
                    <option value="{{ $p->id }}" @selected(request('periode_id') == $p->id)>{{ $p->label() }}</option>
                @endforeach
            </select>
            <select name="user_id" class="{{ $select }}">
                <option value="">Semua user</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" @selected(request('user_id') == $u->id)>{{ $u->name }}</option>
                @endforeach
            </select>
            <select name="aksi" class="{{ $select }}">
                <option value="">Semua aksi</option>
                @foreach (['tambah', 'ubah', 'hapus'] as $a)
                    <option value="{{ $a }}" @selected(request('aksi') === $a)>{{ ucfirst($a) }}</option>
                @endforeach
            </select>
            <button class="rounded-lg bg-admin px-4 py-2 text-sm font-semibold text-white hover:bg-admin-dark">Filter</button>
        </form>

        <div class="overflow-x-auto rounded-xl border border-admin-border bg-white">
            <table class="w-full text-left text-sm">
                <thead class="bg-admin-light/60 text-admin-heading">
                    <tr>
                        <th class="px-4 py-3">Waktu</th><th class="px-4 py-3">User</th><th class="px-4 py-3">Periode</th>
                        <th class="px-4 py-3">Menu</th><th class="px-4 py-3">Aksi</th><th class="px-4 py-3">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        @php
                            $sebelum = $log->sebelum ?? [];
                            $sesudah = $log->sesudah ?? [];
                            $fields = array_keys($log->aksi === 'hapus' ? $sebelum : ($log->aksi === 'tambah' ? $sesudah : $sebelum + $sesudah));
                        @endphp
                        <tr class="border-t border-admin-border align-top">
                            <td class="whitespace-nowrap px-4 py-3">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3">{{ $log->user?->name ?? 'Sistem/Publik' }}</td>
                            <td class="px-4 py-3">{{ $log->periode?->label() ?? '-' }}</td>
                            <td class="px-4 py-3">{{ \App\Models\ActivityLog::LABEL[$log->model] ?? class_basename($log->model) }} <span class="text-admin-text">#{{ $log->model_id }}</span></td>
                            <td class="px-4 py-3"><span class="rounded bg-admin-light px-2 py-0.5 text-xs font-semibold text-admin">{{ $log->aksi }}</span></td>
                            <td class="px-4 py-3">
                                @if ($fields)
                                    <details>
                                        <summary class="cursor-pointer text-admin">Lihat</summary>
                                        <ul class="mt-1 space-y-0.5 text-xs">
                                            @foreach ($fields as $f)
                                                <li>
                                                    <span class="font-semibold">{{ $f }}</span>:
                                                    @if ($log->aksi !== 'tambah') {{ $fmt($sebelum[$f] ?? null) }} @endif
                                                    @if ($log->aksi === 'ubah') → @endif
                                                    @if ($log->aksi !== 'hapus') {{ $fmt($sesudah[$f] ?? null) }} @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </details>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-6 text-center text-admin-text">Belum ada log.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $logs->links() }}
    </div>
@endsection
