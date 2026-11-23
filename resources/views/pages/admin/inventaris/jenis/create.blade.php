@extends('layouts.admin')

@section('title')
    Admin Jenis Inventaris
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-stone-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('jenis-inventaris.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-stone-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-stone-500 text-2xl text-white shadow-lg shadow-stone-500/30"><i class="bx bx-category"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-stone-600">Tambah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Jenis Inventaris PPGT</h1>
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
                <form action="{{ route('jenis-inventaris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama <span class="font-bold text-rose-500">*</label>
                    <input type="text" name="nama" id="nama" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-stone-400 focus:bg-white focus:ring-4 focus:ring-stone-100 disabled:bg-slate-100 mb-6"
                        placeholder="Masukkan Jenis Inventaris">
                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-stone-600 text-white shadow-lg shadow-stone-600/30 hover:bg-stone-700 mt-6!">Simpan</button>
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
