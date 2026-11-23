@extends('layouts.admin')

@section('title')
    Admin Pundi Kasih
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-emerald-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('pundi-kasih.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-emerald-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-emerald-500 text-2xl text-white shadow-lg shadow-emerald-500/30"><i class="bx bx-donate-heart"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-emerald-600">Ubah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Pundi Kasih</h1>
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
                <form action="{{ route('pundi-kasih.update', $data->id) }}" method="POST" >
                    @csrf
                    @method('put')
                    <label for="pertanyaan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Bank : {{ $data->bank->name }} </label>
                        <br>
                    <label for="no_rek" class="inline-block mb-2 text-sm font-semibold text-admin-heading">No Rekening <span class="font-bold text-rose-500">*</label>
                    <input type="text" name="no_rek" id="no_rek" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100 disabled:bg-slate-100 mb-6"
                        value="{{ $data->no_rek }}">

                    <label for="atas_nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Atas Nama <span class="font-bold text-rose-500">*</label>
                    <input type="text" name="atas_nama" id="atas_nama" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-100 disabled:bg-slate-100 mb-6"
                        value="{{ $data->atas_nama }}">

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 hover:bg-emerald-700 mt-6!">Simpan</button>
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
