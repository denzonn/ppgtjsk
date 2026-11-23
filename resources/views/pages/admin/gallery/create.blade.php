@extends('layouts.admin')

@section('title')
    Admin Gallery Kegiatan
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-pink-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('gallery-kegiatan.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-pink-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-pink-500 text-2xl text-white shadow-lg shadow-pink-500/30"><i class="bx bx-images"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-pink-600">Tambah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Gallery Kegiatan PPGT</h1>
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
                <form action="{{ route('gallery-kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="kegiatan" class="inline-block mt-6 mb-2">Nama Kegiatan <span class="font-bold text-rose-500">*</label>
                    <select name="kegiatan_id" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-pink-400 focus:bg-white focus:ring-4 focus:ring-pink-100 disabled:bg-slate-100">
                        @foreach ($kegiatan as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <label for="photo" class="inline-block mt-6 mb-2">Foto Kegiatan <span class="font-bold text-rose-500">*</label>
                    <input type="file" name="photo[]" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-pink-400 focus:bg-white focus:ring-4 focus:ring-pink-100 disabled:bg-slate-100" multiple>

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-pink-600 text-white shadow-lg shadow-pink-600/30 hover:bg-pink-700 mt-6!">Simpan</button>
                </form>

            </div>
        </div>
    </div>
@endsection
