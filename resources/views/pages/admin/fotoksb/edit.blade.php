@extends('layouts.admin')

@section('title')
    Admin Foto KSB
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-rose-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('foto-ksb.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-rose-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-rose-500 text-2xl text-white shadow-lg shadow-rose-500/30"><i class="bx bx-camera"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-rose-600">Ubah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Edit Foto KSB</h1>
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

                <div class="w-[100px] [&_img]:max-h-[400px] [&_img]:max-w-[400px] [&_img]:rounded-full [&_img]:object-cover">
                    <img class="max-w-[400px]" src="{{ Storage::url($ksb->foto) }}" alt="">
                </div>

                <form action="{{ route('foto-ksb.update', $ksb->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama <span class="font-bold text-rose-500">*</span></label>
                    <input type="text" name="nama" id="nama" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-rose-400 focus:bg-white focus:ring-4 focus:ring-rose-100 disabled:bg-slate-100 mb-6"
                        value="{{ $ksb->nama }}">

                    <label for="jabatan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Jabatan <span class="font-bold text-rose-500">*</span></label>
                    <input type="text" name="jabatan" id="jabatan" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-rose-400 focus:bg-white focus:ring-4 focus:ring-rose-100 disabled:bg-slate-100 mb-6"
                        value="{{ $ksb->jabatan }}">

                    <label for="motto" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Motto <span class="font-bold text-rose-500">*</span></label>
                    <textarea name="motto" id="motto" cols="30" rows="10" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-rose-400 focus:bg-white focus:ring-4 focus:ring-rose-100 disabled:bg-slate-100">{!! $ksb->motto !!}</textarea>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="instagram" class="inline-block lg:mt-6 mt-6 mb-2">Instagram</label>
                            <input type="text" name="instagram" id="instagram" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-rose-400 focus:bg-white focus:ring-4 focus:ring-rose-100 disabled:bg-slate-100 mb-6"
                                value="{{ $ksb->instagram }}">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="whatsapp" class="inline-block lg:mt-6 mb-2">Whatsapp</label>
                            <input type="text" name="whatsapp" id="whatsapp" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-rose-400 focus:bg-white focus:ring-4 focus:ring-rose-100 disabled:bg-slate-100 mb-6"
                                value="{{ $ksb->whatsapp }}">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="facebook" class="inline-block lg:mt-6 mb-2">Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-rose-400 focus:bg-white focus:ring-4 focus:ring-rose-100 disabled:bg-slate-100 mb-6"
                                value="{{ $ksb->facebook }}">
                        </div>
                    </div>

                    <label for="url_youtube" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Foto <span class="font-bold text-rose-500">*</span></label>
                    <div class="text-[#a1acb8]">Jika tidak ingin mengganti foto tidak perlu mengupload</div>
                    <input type="file" name="foto" id="foto" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-rose-400 focus:bg-white focus:ring-4 focus:ring-rose-100 disabled:bg-slate-100 mb-6">

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-rose-600 text-white shadow-lg shadow-rose-600/30 hover:bg-rose-700">Ubah</button>
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
