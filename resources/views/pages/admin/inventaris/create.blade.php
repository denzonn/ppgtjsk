@extends('layouts.admin')

@section('title')
    Admin Invetaris
@endsection

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-slate-50 px-6 py-5 md:px-8">
                <a href="{{ route('inventaris.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-lg bg-white text-slate-500 border border-admin-border transition hover:text-slate-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-xl bg-slate-500 text-2xl text-white"><i class="bx bx-package"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-600">Tambah data</p>
                    <h1 class="text-xl font-semibold text-admin-heading">Invetaris PPGT</h1>
                </div>
            </div>
            <div class="p-6 md:p-8">
                @if ($errors->any())
                    <div class="mb-6 rounded-xl p-4 [&_ul]:list-disc [&_ul]:pl-5 bg-danger-50 text-danger-700 ring-1 ring-danger-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama <span class="font-bold text-danger-500">*</label>
                    <input type="text" name="nama" id="nama" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-100 disabled:bg-slate-100 mb-6">

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-6/12">
                            <label for="kode" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Kode <span class="font-bold text-danger-500">*</label>
                            <input type="text" name="kode" id="kode" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-100 disabled:bg-slate-100 mb-6">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-6/12">
                            <label for="jenis_id" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Jenis Inventaris <span class="font-bold text-danger-500">*</label>
                            <select name="jenis_id" id="" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-100 disabled:bg-slate-100 mb-6">
                                @foreach ($jenisInventaris as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-6/12">
                            <label for="jumlah" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Jumlah <span class="font-bold text-danger-500">*</label>
                            <input type="number" name="jumlah" id="jumlah" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-100 disabled:bg-slate-100 mb-6">
                        </div>

                        <div class="shrink-0 px-3 w-full lg:w-6/12">
                            <label for="keterangan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Keterangan <span class="font-bold text-danger-500">*</label>
                            <select name="keterangan" id="" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-100 disabled:bg-slate-100 mb-6">
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Hilang">Hilang</option>
                            </select>
                        </div>
                    </div>

                    <label for="photo" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Foto <span class="font-bold text-danger-500">*</label>
                    <input type="file" name="photo" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:bg-white focus:ring-4 focus:ring-slate-100 disabled:bg-slate-100">

                    <button type="submit" class="block w-full rounded-lg text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-slate-600 text-white hover:bg-slate-700 mt-6!">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#isi'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
