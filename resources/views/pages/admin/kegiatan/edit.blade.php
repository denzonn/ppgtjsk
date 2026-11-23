@extends('layouts.admin')

@section('title')
    Admin Kegiatan
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-teal-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('kegiatan.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-teal-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-teal-500 text-2xl text-white shadow-lg shadow-teal-500/30"><i class="bx bx-calendar-star"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-teal-600">Ubah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Kegiatan PPGT</h1>
                </div>
            </div>
            <div class="p-6 md:p-8">
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl p-4 [&_ul]:list-disc [&_ul]:pl-5 bg-rose-50 text-rose-700 ring-1 ring-rose-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full md:w-6/12">
                            <label for="nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Kegiatan <span class="font-bold text-rose-500">*</label>
                            <input type="text" name="name" id="nama" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-teal-400 focus:bg-white focus:ring-4 focus:ring-teal-100 disabled:bg-slate-100 mb-6"
                                value="{{ $kegiatan->name }}">
                        </div>
                        <div class="shrink-0 px-3 w-full md:w-6/12">
                            <label for="proker" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Program Kerja <span class="font-bold text-rose-500">*</label>
                            <select name="program_id" id="" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-teal-400 focus:bg-white focus:ring-4 focus:ring-teal-100 disabled:bg-slate-100 mb-6">
                                <option value="{{ $kegiatan->program_id }}">{{ $kegiatan->program->name }}</option>
                                @foreach ($program as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="description" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Deskripsi Kegiatan <span class="font-bold text-rose-500">*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-teal-400 focus:bg-white focus:ring-4 focus:ring-teal-100 disabled:bg-slate-100">{!! $kegiatan->description !!}</textarea>

                    <label for="link_drive" class="inline-block mb-2 text-sm font-semibold text-admin-heading mt-6">Link Drive</label>
                    <div class="-mx-3 flex flex-wrap" id="link-inputs">

                        @if ($linkDrive)
                            @foreach ($linkDrive as $index => $link)
                                <div class="-mx-3 flex flex-wrap">
                                    <div class="shrink-0 px-3 w-full md:w-8/12">
                                        <input type="text" name="link_drive[]" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-teal-400 focus:bg-white focus:ring-4 focus:ring-teal-100 disabled:bg-slate-100 mb-6"
                                            placeholder="Masukkan Link Google Drive" value="{{ $link }}">
                                    </div>
                                    @if ($index === 0)
                                        <div class="shrink-0 px-3 w-full md:w-4/12">
                                            <button class="inline-block rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-teal-600 text-white shadow-lg shadow-teal-600/30 hover:bg-teal-700 add-link" type="button">Tambah Link</button>
                                        </div>
                                    @else
                                        <div class="shrink-0 px-3 w-full md:w-4/12">
                                            <button class="inline-block rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-rose-500 text-white shadow-lg shadow-rose-500/30 hover:bg-rose-600 remove-link" type="button">Hapus Link</button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="-mx-3 flex flex-wrap">
                                <div class="shrink-0 px-3 w-full md:w-8/12">
                                    <input type="text" name="link_drive[]" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-teal-400 focus:bg-white focus:ring-4 focus:ring-teal-100 disabled:bg-slate-100 mb-6"
                                        placeholder="Masukkan Link Google Drive" >
                                </div>
                                <div class="shrink-0 px-3 w-full md:w-4/12">
                                    <button class="inline-block rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-teal-600 text-white shadow-lg shadow-teal-600/30 hover:bg-teal-700 add-link" type="button">Tambah Link</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <label for="photo" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Foto Kegiatan </label>
                    <p class="mb-4 text-[#f00] text-[0.8rem]"><span class="font-bold text-rose-500">* Tidak Perlu Upload Foto Jika Tidak Ingin
                            Ganti</p>
                    <input type="file" name="photo" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-teal-400 focus:bg-white focus:ring-4 focus:ring-teal-100 disabled:bg-slate-100">

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-teal-600 text-white shadow-lg shadow-teal-600/30 hover:bg-teal-700 mt-6!">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                //tambahkan plugin upload gambar
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.add-link').addEventListener('click', function() {
                var linkInputs = document.getElementById('link-inputs');
                var newRow = document.createElement('div');
                newRow.className = 'link-row flex w-full flex-wrap';
                newRow.innerHTML = `
                    <div class="shrink-0 px-3 w-full md:w-8/12">
                        <input type="text" name="link_drive[]" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-teal-400 focus:bg-white focus:ring-4 focus:ring-teal-100 disabled:bg-slate-100 mb-6" placeholder="Masukkan Link Google Drive">
                    </div>
                    <div class="shrink-0 px-3 w-full md:w-4/12">
                        <button class="inline-block rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-rose-500 text-white shadow-lg shadow-rose-500/30 hover:bg-rose-600 remove-link" type="button">Hapus Link</button>
                    </div>
                `;
                linkInputs.appendChild(newRow);
            });

            // Menambahkan event listener untuk menghapus link
            document.addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('remove-link')) {
                    event.target.closest('.link-row').remove();
                }
            });
        });
    </script>
@endpush
