@extends('layouts.admin')

@section('title')
    Admin Pengurus
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-amber-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('pengurus.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-amber-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-amber-500 text-2xl text-white shadow-lg shadow-amber-500/30"><i class="bx bx-user-plus"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-600">Ubah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Edit Pengurus</h1>
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

                <form action="{{ route('pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <label for="nama_anggota" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama <span class="font-bold text-rose-500">*</span></label>
                    <input type="text" name="nama_anggota" id="nama_anggota" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-amber-400 focus:bg-white focus:ring-4 focus:ring-amber-100 disabled:bg-slate-100 mb-6"
                        placeholder="Masukkan Nama Pengurus" value="{{ $pengurus->nama_anggota }}">

                    <label for="jabatan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Jabatan <span class="font-bold text-rose-500">*</span></label>
                    <select name="jabatans_id" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-amber-400 focus:bg-white focus:ring-4 focus:ring-amber-100 disabled:bg-slate-100 mb-6">
                        <option value="{{ $pengurus->jabatans_id }}">{{ $pengurus->jabatan->nama_jabatan }}</option>
                        @foreach ($jabatan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                        @endforeach
                    </select>

                    <label for="bidang" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Bidang <span class="font-bold text-rose-500">*</span></label>
                    <select name="bidangs_id" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-amber-400 focus:bg-white focus:ring-4 focus:ring-amber-100 disabled:bg-slate-100 mb-6">
                        <option value="{{ $pengurus->bidangs_id }}">{{ $pengurus->bidang->nama_bidang }}</option>
                        @foreach ($bidang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_bidang }}</option>
                        @endforeach
                    </select>

                    <label for="foto" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Foto <span class="font-bold text-rose-500">*</span></label>
                    <input type="file" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-amber-400 focus:bg-white focus:ring-4 focus:ring-amber-100 disabled:bg-slate-100 mb-6" name="foto">

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-amber-600 text-white shadow-lg shadow-amber-600/30 hover:bg-amber-700">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#motto'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
