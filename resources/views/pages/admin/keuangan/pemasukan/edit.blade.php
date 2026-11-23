@extends('layouts.admin')

@section('title')
    Admin Keuangan - Pemasukan
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-green-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('pemasukan.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-green-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-green-500 text-2xl text-white shadow-lg shadow-green-500/30"><i class="bx bx-trending-up"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-green-600">Ubah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Edit Pemasukan PPGT</h1>
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
                <form action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="tanggal" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Tanggal Pemasukan <span class="font-bold text-rose-500">*</label>
                    <input type="date" name="tanggal" id="tanggal" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-green-400 focus:bg-white focus:ring-4 focus:ring-green-100 disabled:bg-slate-100 mb-6"
                        value="{{ $pemasukan->tanggal }}">

                    <label for="keterangan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Keterangan <span class="font-bold text-rose-500">*</label>
                    <input type="text" name="keterangan" id="keterangan" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-green-400 focus:bg-white focus:ring-4 focus:ring-green-100 disabled:bg-slate-100 mb-6"
                        placeholder="Keterangan Pemasukan" value="{{ $pemasukan->keterangan }}">

                    <label for="jumlah" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nominal <span class="font-bold text-rose-500">*</label>
                    <input type="number" name="jumlah" id="jumlah" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-green-400 focus:bg-white focus:ring-4 focus:ring-green-100 disabled:bg-slate-100 mb-6"
                        placeholder="Masukkan Nominal Pemasukan" value="{{ $pemasukan->jumlah }}">

                    <label for="catatan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Catatan </label>
                    <textarea name="catatan" id="catatan" cols="30" rows="10" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-green-400 focus:bg-white focus:ring-4 focus:ring-green-100 disabled:bg-slate-100">{!! $pemasukan->catatan !!}</textarea>

                    <label for="photo" class="inline-block mt-6 mb-2">Foto Slip </label>
                    <p class="mb-4 text-[#f00] text-[0.8rem]"><span class="font-bold text-rose-500">* Tidak Perlu Upload Foto Jika Tidak Ingin
                            Ganti</p>
                    <input type="file" name="photo" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-green-400 focus:bg-white focus:ring-4 focus:ring-green-100 disabled:bg-slate-100">

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-green-600 text-white shadow-lg shadow-green-600/30 hover:bg-green-700 mt-6!">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#catatan'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        // Mendapatkan elemen input tanggal
        const tanggalInput = document.getElementById('tanggal');

        // Mendapatkan tanggal hari ini
        const today = new Date().toISOString().split('T')[0];

        // Mengatur atribut max pada elemen input tanggal menjadi tanggal hari ini
        tanggalInput.setAttribute('max', today);
    </script>
@endpush
