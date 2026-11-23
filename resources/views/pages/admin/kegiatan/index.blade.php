@extends('layouts.admin')

@section('title')
    Kegiatan
@endsection

@section('content')
    {{-- Header: tab-like dengan statistik unggulan --}}
    <header class="mb-8 flex flex-wrap items-center gap-4 rounded-3xl bg-teal-950 p-6 text-white md:p-8">
        <span class="grid size-14 place-items-center rounded-2xl bg-teal-400 text-3xl text-teal-950"><i class="bx bx-calendar-star"></i></span>
        <div class="flex-1">
            <h1 class="text-2xl font-extrabold md:text-3xl">Kegiatan PPGT</h1>
            <p class="text-teal-200">Pilih maksimal 6 kegiatan unggulan yang tampil di beranda, lalu simpan.</p>
        </div>
        <a href="{{ route('kegiatan.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-teal-400 px-5 py-3 font-bold text-teal-950 transition hover:bg-teal-300">
            <i class="bx bx-plus text-xl"></i> Tambah Kegiatan
        </a>
    </header>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($kegiatan as $item)
            <article class="group relative flex flex-col overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border transition has-[.checkbox:checked]:ring-2 has-[.checkbox:checked]:ring-teal-400">
                <div class="relative aspect-[16/10] overflow-hidden">
                    <img src="{{ Storage::url($item->photo) }}" alt="" class="size-full object-cover transition duration-500 group-hover:scale-105">
                    <span class="absolute bottom-3 left-3 rounded-full bg-black/60 px-3 py-1 text-xs font-semibold text-white backdrop-blur">{{ $item->program->name ?? '-' }}</span>
                    {{-- Sakelar unggulan beranda --}}
                    <label class="absolute right-3 top-3 flex cursor-pointer items-center gap-2 rounded-full bg-white/95 py-1.5 pl-3 pr-1.5 text-xs font-bold text-slate-600 shadow-lg has-[:checked]:bg-teal-400 has-[:checked]:text-teal-950">
                        Beranda
                        <input type="checkbox" name="selectedIds[]" value="{{ $item->id }}" class="checkbox peer sr-only" {{ $item->checked ? 'checked' : '' }}>
                        <span class="grid size-6 place-items-center rounded-full bg-slate-200 text-slate-400 peer-checked:bg-white peer-checked:text-teal-600"><i class="bx bxs-star"></i></span>
                    </label>
                </div>
                <div class="flex flex-1 flex-col p-5">
                    <h2 class="text-lg font-bold text-admin-heading">{{ $item->name }}</h2>
                    <p class="mt-1 line-clamp-2 text-sm text-slate-500">{{ strip_tags($item->description) }}</p>
                    <div class="mt-auto flex gap-2 pt-4">
                        <a href="{{ route('kegiatan.edit', $item->id) }}"
                            class="flex-1 rounded-xl bg-teal-50 py-2 text-center text-sm font-semibold text-teal-700 hover:bg-teal-100"><i class="bx bx-edit-alt"></i> Ubah</a>
                        <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="grid h-full w-11 place-items-center rounded-xl bg-slate-50 text-slate-500 hover:bg-rose-50 hover:text-rose-600"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <p class="col-span-full rounded-2xl bg-white p-10 text-center text-slate-400 ring-1 ring-admin-border">Belum ada kegiatan.</p>
        @endforelse
    </div>

    {{-- Bilah simpan unggulan --}}
    <div class="sticky bottom-6 z-20 mx-auto mt-8 flex w-fit items-center gap-4 rounded-full bg-admin-ink py-2 pl-6 pr-2 text-white shadow-2xl shadow-black/30">
        <span class="text-sm">Unggulan beranda: <b data-checked-count class="text-teal-300">0</b>/6</span>
        <button type="button" id="checkedActivity"
            class="rounded-full bg-teal-400 px-5 py-2 text-sm font-bold text-teal-950 transition hover:bg-teal-300">Simpan pilihan</button>
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
