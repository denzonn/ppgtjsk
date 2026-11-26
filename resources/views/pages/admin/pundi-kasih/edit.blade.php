@extends('layouts.admin')

@section('title')
    Admin Pundi Kasih
@endsection

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-admin-light/60 px-5 py-4 md:px-6">
                <a href="{{ route('pundi-kasih.index') }}" title="Kembali"
                    class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-admin text-lg text-white"><i class="bx bx-donate-heart"></i></span>
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Ubah data</p>
                    <h1 class="text-base font-bold text-admin-heading">Pundi Kasih</h1>
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
                <form action="{{ route('pundi-kasih.update', $data->id) }}" method="POST" >
                    @csrf
                    @method('put')
                    <label for="pertanyaan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Bank : {{ $data->bank->name }} </label>
                        <br>
                    <label for="no_rek" class="inline-block mb-2 text-sm font-semibold text-admin-heading">No Rekening <span class="font-bold text-danger-500">*</label>
                    <input type="text" name="no_rek" id="no_rek" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                        value="{{ $data->no_rek }}">

                    <label for="atas_nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Atas Nama <span class="font-bold text-danger-500">*</label>
                    <input type="text" name="atas_nama" id="atas_nama" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                        value="{{ $data->atas_nama }}">

                    <button type="submit" class="block w-full rounded-lg text-center text-sm font-semibold transition-colors px-5 py-2.5 bg-admin text-white hover:bg-admin-dark mt-6!">Simpan</button>
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
