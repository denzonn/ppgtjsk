@extends('layouts.admin')

@section('title')
    Admin Kegiatan
@endsection

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-admin-light/60 px-5 py-4 md:px-6">
                <a href="{{ route('kegiatan.index') }}" title="Kembali"
                    class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-admin text-lg text-white"><i class="bx bx-calendar-star"></i></span>
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Tambah data</p>
                    <h1 class="text-base font-bold text-admin-heading">Kegiatan PPGT</h1>
                </div>
            </div>
            <div class="p-5 md:p-6">
                @if ($errors->any())
                    <div class="mb-6 rounded-xl p-4 [&_ul]:list-disc [&_ul]:pl-5 bg-danger-50 text-danger-700 ring-1 ring-danger-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full md:w-6/12">
                            <label for="nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Kegiatan <span class="font-bold text-danger-500">*</label>
                            <input type="text" name="name" id="nama" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                                placeholder="Masukkan Nama Kegiatan">
                        </div>
                        <div class="shrink-0 px-3 w-full md:w-6/12">
                            <label for="proker" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Program Kerja <span class="font-bold text-danger-500">*</label>
                            <select name="program_id" id="" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6">
                                @foreach ($program as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <label for="description" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Deskripsi Kegiatan <span class="font-bold text-danger-500">*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100"></textarea>

                    <label for="link_drive" class="inline-block mb-2 text-sm font-semibold text-admin-heading mt-6">Link Drive</label>
                    <div class="-mx-3 flex flex-wrap" id="link-inputs">
                        <div class="shrink-0 px-3 w-full md:w-8/12">
                            <input type="text" name="link_drive[]" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6" placeholder="Masukkan Link Google Drive">
                        </div>
                        <div class="shrink-0 px-3 w-full md:w-4/12">
                            <button class="inline-flex w-full items-center justify-center gap-1 rounded-lg border border-dashed border-ink-300 bg-white px-4 py-2.5 text-sm font-semibold text-admin transition-colors hover:border-admin hover:bg-admin-light add-link" type="button">Tambah Link</button>
                        </div>
                    </div>

                    @include('pages.admin.partials.photo-picker', ['name' => 'photo', 'label' => 'Foto Kegiatan', 'required' => true, 'shape' => 'wide', 'hint' => 'Foto utama kegiatan (landscape), maks 3 MB.'])

                    <button type="submit" class="block w-full rounded-lg text-center text-sm font-semibold transition-colors px-5 py-2.5 bg-admin text-white hover:bg-admin-dark mt-6!">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.add-link').addEventListener('click', function () {
                var linkInputs = document.getElementById('link-inputs');
                var newRow = document.createElement('div');
                newRow.className = 'link-row flex w-full flex-wrap';
                newRow.innerHTML = `
                    <div class="shrink-0 px-3 w-full md:w-8/12">
                        <input type="text" name="link_drive[]" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6" placeholder="Masukkan Link Google Drive">
                    </div>
                    <div class="shrink-0 px-3 w-full md:w-4/12">
                        <button class="inline-flex w-full items-center justify-center rounded-lg border border-danger-200 bg-white px-4 py-2.5 text-sm font-semibold text-danger-600 transition-colors hover:bg-danger-50 remove-link" type="button">Hapus Link</button>
                    </div>
                `;
                linkInputs.appendChild(newRow);
            });

            // Menambahkan event listener untuk menghapus link
            document.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('remove-link')) {
                    event.target.closest('.link-row').remove();
                }
            });
        });
    </script>

@endpush
