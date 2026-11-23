@extends('layouts.admin')

@section('title')
    Admin Frequenly Ask Question
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-sky-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('faq.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-sky-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-sky-500 text-2xl text-white shadow-lg shadow-sky-500/30"><i class="bx bx-help-circle"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-600">Tambah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Frequenly Ask Question</h1>
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
                <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="pertanyaan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Pertanyaan <span class="font-bold text-rose-500">*</label>
                    <input type="text" name="pertanyaan" id="pertanyaan" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">

                    <label for="jawaban" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Jawaban <span class="font-bold text-rose-500">*</label>
                    <textarea name="jawaban" id="jawaban" cols="30" rows="10"></textarea>

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-sky-600 text-white shadow-lg shadow-sky-600/30 hover:bg-sky-700 mt-6!">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#jawaban'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
