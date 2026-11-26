@extends('layouts.admin')

@section('title')
    Admin Notulensi Rapat
@endsection

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-admin-light/60 px-5 py-4 md:px-6">
                <a href="{{ route('notulensi-rapat.index') }}" title="Kembali"
                    class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-admin text-lg text-white"><i class="bx bx-notepad"></i></span>
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Ubah data</p>
                    <h1 class="text-base font-bold text-admin-heading">Notulensi Rapat PPGT</h1>
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
                <form action="{{ route('notulensi-rapat.update', $notulen->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <label for="tanggal" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Tanggal <span class="font-bold text-danger-500">*</label>
                    <input type="date" name="tanggal" id="tanggal" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6">

                    <label for="judul" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Judul <span class="font-bold text-danger-500">*</label>
                    <input type="text" name="judul" id="judul" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                        value="{{ $notulen->judul }}">

                    <label for="isi" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Isi <span class="font-bold text-danger-500">*</label>
                    <textarea name="isi" id="isi" cols="30" rows="10">{!! $notulen->isi !!}</textarea>

                    <label for="file" class="inline-block mt-6 mb-2">File </label>
                    <div class="text-[#f00]"><span class="font-bold text-danger-500">* Jika tidak ingin mengganti file tidak perlu upload</div>
                    <input type="file" name="file" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100">

                    <button type="submit" class="block w-full rounded-lg text-center text-sm font-semibold transition-colors px-5 py-2.5 bg-admin text-white hover:bg-admin-dark mt-6!">Simpan</button>
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
