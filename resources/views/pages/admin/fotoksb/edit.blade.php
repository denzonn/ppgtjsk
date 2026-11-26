@extends('layouts.admin')

@section('title')
    Admin Foto KSB
@endsection

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-admin-light/60 px-5 py-4 md:px-6">
                <a href="{{ route('foto-ksb.index') }}" title="Kembali"
                    class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-admin text-lg text-white"><i class="bx bx-camera"></i></span>
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Ubah data</p>
                    <h1 class="text-base font-bold text-admin-heading">Edit Foto KSB</h1>
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


                <form action="{{ route('foto-ksb.update', $ksb->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama <span class="font-bold text-danger-500">*</span></label>
                    <input type="text" name="nama" id="nama" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                        value="{{ $ksb->nama }}">

                    <label for="jabatan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Jabatan <span class="font-bold text-danger-500">*</span></label>
                    <input type="text" name="jabatan" id="jabatan" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                        value="{{ $ksb->jabatan }}">

                    <label for="motto" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Motto <span class="font-bold text-danger-500">*</span></label>
                    <textarea name="motto" id="motto" cols="30" rows="10" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100">{!! $ksb->motto !!}</textarea>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="instagram" class="inline-block lg:mt-6 mt-6 mb-2">Instagram</label>
                            <input type="text" name="instagram" id="instagram" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                                value="{{ $ksb->instagram }}">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="whatsapp" class="inline-block lg:mt-6 mb-2">Whatsapp</label>
                            <input type="text" name="whatsapp" id="whatsapp" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                                value="{{ $ksb->whatsapp }}">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="facebook" class="inline-block lg:mt-6 mb-2">Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                                value="{{ $ksb->facebook }}">
                        </div>
                    </div>

                    @include('pages.admin.partials.photo-picker', ['name' => 'foto', 'label' => 'Foto', 'current' => $ksb->foto, 'shape' => 'portrait', 'hint' => 'Foto potret (tegak), maks 5 MB. Biarkan jika tidak ingin mengganti.'])

                    <button type="submit" class="block w-full rounded-lg text-center text-sm font-semibold transition-colors px-5 py-2.5 bg-admin text-white hover:bg-admin-dark">Ubah</button>
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
