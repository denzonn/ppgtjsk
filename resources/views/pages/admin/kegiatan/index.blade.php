@extends('layouts.admin')

@section('title')
    Kegiatan
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Judul --}}
        <header class="flex flex-col justify-between gap-4 rounded-xl bg-admin-ink p-5 text-white md:flex-row md:items-center">
            <div class="flex items-center gap-3">
                <span class="grid size-10 place-items-center rounded-lg bg-white/10">
                    <span class="material-symbols-outlined text-[22px]!" aria-hidden="true">event</span>
                </span>
                <div>
                    <h1 class="text-xl font-bold tracking-tight">Kegiatan PPGT</h1>
                    <p class="text-sm text-ink-200">Tandai ★ maksimal 6 kegiatan unggulan untuk beranda, lalu simpan.</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="whitespace-nowrap rounded-lg bg-white/10 px-3 py-2 text-xs"><b class="font-mono">{{ $kegiatan->count() }}</b> kegiatan</span>
                <a href="{{ route('kegiatan.create') }}"
                    class="inline-flex shrink-0 items-center gap-1.5 whitespace-nowrap rounded-lg bg-white px-3.5 py-2 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-light">
                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">add</span> Tambah Kegiatan
                </a>
            </div>
        </header>

        <section class="overflow-hidden rounded-xl border border-admin-border bg-white">
            {{-- Cari --}}
            <label class="flex items-center gap-2 border-b border-admin-border px-4 py-3 focus-within:bg-admin-light/40">
                <span class="material-symbols-outlined text-[18px]! text-admin-text" aria-hidden="true">search</span>
                <input type="search" data-filter="#kegiatan" placeholder="Cari kegiatan atau program…" class="w-full bg-transparent text-sm outline-none placeholder:text-admin-text">
            </label>

            <ul id="kegiatan" class="divide-y divide-admin-border">
                @forelse ($kegiatan as $item)
                    <li data-item class="flex items-center gap-4 px-4 py-3 transition-colors hover:bg-admin-body/60 has-[.checkbox:checked]:bg-admin-light/50">
                        <span class="relative aspect-[4/3] w-20 shrink-0 overflow-hidden rounded-lg">
                            <span class="absolute inset-0 grid place-items-center bg-admin-light text-ink-300"><span class="material-symbols-outlined text-[22px]!" aria-hidden="true">event</span></span>
                            <img src="{{ $item->photo }}" alt="" loading="lazy" onerror="this.hidden=true" class="relative size-full object-cover">
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="flex flex-wrap items-center gap-2">
                                <span class="font-semibold text-admin-heading">{{ $item->name }}</span>
                                <span class="rounded-full bg-admin-body px-2 py-0.5 text-[11px] font-medium text-admin-text">{{ $item->program->name ?? '-' }}</span>
                            </p>
                            <p class="mt-0.5 truncate text-sm text-admin-text">{{ strip_tags($item->description) }}</p>
                        </div>
                        {{-- Sakelar unggulan beranda --}}
                        <label title="Unggulan beranda"
                            class="grid size-9 shrink-0 cursor-pointer place-items-center rounded-lg text-slate-300 transition-colors hover:bg-admin-body hover:text-bronze-400 has-[:checked]:text-bronze-400">
                            <input type="checkbox" name="selectedIds[]" value="{{ $item->id }}" class="checkbox peer sr-only" {{ $item->checked ? 'checked' : '' }}>
                            <span class="material-symbols-outlined text-[22px]! peer-checked:[font-variation-settings:'FILL'_1]" aria-hidden="true">star</span>
                        </label>
                        <a href="{{ route('kegiatan.edit', $item->id) }}" title="Ubah"
                            class="grid size-9 shrink-0 place-items-center rounded-lg text-admin-text transition-colors hover:bg-admin-body hover:text-admin-heading">
                            <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">edit</span></a>
                        <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="grid size-9 place-items-center rounded-lg text-admin-text transition-colors hover:bg-danger-50 hover:text-danger-600">
                                <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">delete</span></button>
                        </form>
                    </li>
                @empty
                    <li class="p-10 text-center text-sm text-admin-text">Belum ada kegiatan.</li>
                @endforelse
            </ul>
        </section>

        {{-- Bilah simpan unggulan --}}
        <div class="sticky bottom-6 z-20 mx-auto flex w-fit items-center gap-3 rounded-full bg-admin-ink py-1.5 pl-5 pr-1.5 text-white shadow-lg shadow-black/20">
            <span class="flex items-center gap-1 text-xs"><span class="material-symbols-outlined text-[15px]! text-bronze-400 [font-variation-settings:'FILL'_1]" aria-hidden="true">star</span>
                Unggulan beranda: <b data-checked-count class="font-mono">0</b><span class="text-ink-200">/6</span></span>
            <button type="button" id="checkedActivity"
                class="rounded-full bg-white px-4 py-1.5 text-xs font-semibold text-admin-heading transition-colors hover:bg-admin-light">Simpan pilihan</button>
        </div>
    </div>

    <form action="{{ route('checked-activity') }}" method="POST" id="deleteForm" class="hidden">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedIdsToDelete">
    </form>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            const updateCount = () => $('[data-checked-count]').text($('input.checkbox:checked').length);
            $('input.checkbox').on('change', updateCount);
            updateCount();

            $('#checkedActivity').on('click', function() {
                var selectedIds = [];
                $('input.checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    alert('Tidak ada kegiatan yang dipilih.');
                } else if (selectedIds.length > 6) {
                    alert('Maksimal hanya boleh memilih 6 kegiatan.');
                } else {
                    $('#deleteForm input[name="selectedIdsToDelete"]').val(selectedIds.join(','));
                    $('#deleteForm').submit();
                }
            });
        });
    </script>
@endpush
