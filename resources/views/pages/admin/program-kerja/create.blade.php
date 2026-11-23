@extends('layouts.admin')

@section('title')
    Admin Program Kerja
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-violet-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('program-kerja.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-violet-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-violet-500 text-2xl text-white shadow-lg shadow-violet-500/30"><i class="bx bx-task"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-violet-600">Tambah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Program Kerja PPGT</h1>
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
                <form action="{{ route('program-kerja.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="name" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Program Kerja <span class="font-bold text-rose-500">*</label>
                    <input type="text" name="name" id="name" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100 disabled:bg-slate-100 mb-6"
                        placeholder="Masukkan Nama Program">

                    <label for="bidang_id" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Bidang <span class="font-bold text-rose-500">*</label>
                    <select name="bidang_id" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100 disabled:bg-slate-100 mb-6">
                        @foreach ($bidang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_bidang }}</option>
                        @endforeach
                    </select>

                    <label for="description" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Deskripsi Kegiatan <span class="font-bold text-rose-500">*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100 disabled:bg-slate-100"></textarea>

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-violet-600 text-white shadow-lg shadow-violet-600/30 hover:bg-violet-700 mt-6!">Simpan</button>
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
@endpush
