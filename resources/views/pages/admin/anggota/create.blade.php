@extends('layouts.admin')

@section('title')
    Admin Data Anggota
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-sky-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('data-anggota.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-sky-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-sky-500 text-2xl text-white shadow-lg shadow-sky-500/30"><i class="bx bx-id-card"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-600">Tambah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Tambahkan Anggota</h1>
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

                <form action="{{ route('data-anggota.store') }}" method="POST">
                    @csrf

                    <label for="nik" class="inline-block mb-2 text-sm font-semibold text-admin-heading">NIK <span class="font-bold text-rose-500">*</span></label>
                    <input type="text" name="nik" id="nik" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                        placeholder="Masukkan NIK anda" value="{{ old('nik') }}">

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-6/12">
                            <label for="nama" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama <span class="font-bold text-rose-500">*</span></label>
                            <input type="text" name="nama" id="nama" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                                placeholder="Masukkan Nama Anda" value="{{ old('nama') }}">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-6/12">
                            <label for="email" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Email <span class="font-bold text-rose-500">*</span></label>
                            <input type="email" name="email" id="email" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                                placeholder="Masukkan Email Anda" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-6/12">
                            <label for="no_hp" class="inline-block mb-2 text-sm font-semibold text-admin-heading">No HP <span class="font-bold text-rose-500">*</span></label>
                            <input type="number" name="no_hp" id="no_hp" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                                placeholder="Masukkan No HP Anda" value="{{ old('no_hp') }}">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-6/12">
                            <label for="tempat_lahir" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Tempat Lahir <span class="font-bold text-rose-500">*</span></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                                placeholder="Masukkan Tempat Lahir Anda" value="{{ old('tempat_lahir') }}">
                        </div>
                    </div>

                    <label for="tanggal_lahir" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Tanggal Lahir <span class="font-bold text-rose-500">*</span></label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                        value="{{ old('tangga_lahir') }}">

                    <label for="alamat" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Alamat <span class="font-bold text-rose-500">*</span></label>
                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                        placeholder="Masukkan Alamat Anda">{{ old('alamat') }}</textarea>


                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="jenis_kelamin" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Jenis Kelamin <span class="font-bold text-rose-500">*</span></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="Laki-laki" @if (old('jenis_kelamin') == 'Laki-laki') selected @endif>Laki-laki
                                </option>
                                <option value="Perempuan" @if (old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="golongan_darah" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Golongan Darah <span class="font-bold text-rose-500">*</span></label>
                            <select name="golongan_darah" id="golongan_darah" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="A" @if (old('golongan_darah') == 'A') selected @endif>A</option>
                                <option value="B" @if (old('golongan_darah') == 'B') selected @endif>B</option>
                                <option value="AB" @if (old('golongan_darah') == 'AB') selected @endif>AB</option>
                                <option value="O" @if (old('golongan_darah') == 'O') selected @endif>O</option>
                                <option value="Tidak Tahu" @if (old('golongan_darah') == 'Tidak Tahu') selected @endif>Tidak Tahu
                                </option>
                            </select>
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="rhesus" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Rhesus <span class="font-bold text-rose-500">*</span></label>
                            <select name="rhesus" id="rhesus" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="+" @if (old('rhesus') == '+') selected @endif>+</option>
                                <option value="-" @if (old('rhesus') == '-') selected @endif>-</option>
                            </select>
                        </div>
                    </div>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="bersedia" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Apakah Anda Bersedia Mendonor Darah? <span
                                    class="font-bold text-rose-500">*</span></label>
                            <select name="bersedia" id="bersedia" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="Ya" @if (old('bersedia') == 'Ya') selected @endif>Ya</option>
                                <option value="Tidak" @if (old('bersedia') == 'Tidak') selected @endif>Tidak</option>
                            </select>
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="status" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Status <span class="font-bold text-rose-500">*</span></label>
                            <select name="status" id="status" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="Menikah" @if (old('status') == 'Menikah') selected @endif>Menikah
                                </option>
                                <option value="Belum Menikah" @if (old('status') == 'Belum Menikah') selected @endif>Belum
                                    Menikah</option>
                            </select>
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="keanggotaan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Keanggotaan <span class="font-bold text-rose-500">*</span></label>
                            <select name="keanggotaan" id="keanggotaan" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="SIDI" @if (old('keanggotaan') == 'SIDI') selected @endif>SIDI</option>
                                <option value="BAPTIS" @if (old('keanggotaan') == 'BAPTIS') selected @endif>BAPTIS</option>
                                <option value="BAPTIS DEWASA" @if (old('keanggotaan') == 'BAPTIS DEWASA') selected @endif>BAPTIS
                                    DEWASA</option>
                                <option value="BELUM" @if (old('keanggotaan') == 'BELUM') selected @endif>Belum</option>
                            </select>
                        </div>
                    </div>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="pendidikan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Pendidikan Terakhir <span
                                    class="font-bold text-rose-500">*</span></label>
                            <select name="pendidikan" id="pendidikan" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="SD / Sederajat" @if (old('pendidikan') == 'SD / Sederajat') selected @endif>SD /
                                    Sederajat</option>
                                <option value="SMP / Sederajat" @if (old('pendidikan') == 'SMP / Sederajat') selected @endif>SMP /
                                    Sederajat</option>
                                <option value="SMA / Sederajat" @if (old('pendidikan') == 'SMA / Sederajat') selected @endif>SMA /
                                    Sederajat</option>
                                <option value="D3 (Diploma)" @if (old('pendidikan') == 'D3 (Diploma)') selected @endif>D3
                                    (Diploma)</option>
                                <option value="S1 (Sarjana)" @if (old('pendidikan') == 'S1 (Sarjana)') selected @endif>S1
                                    (Sarjana)</option>
                                <option value="S2 (Magister)" @if (old('pendidikan') == 'S2 (Magister)') selected @endif>S2
                                    (Magister)</option>
                                <option value="S3 (Doktor)" @if (old('pendidikan') == 'S3 (Doktor)') selected @endif>S3 (Doktor)
                                </option>
                            </select>
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="pekerjaan" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Pekerjaan <span class="font-bold text-rose-500">*</span></label>
                            <select name="pekerjaan" id="pekerjaan" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="Pelajar" @if (old('pekerjaan') == 'Pelajar') selected @endif>Pelajar
                                </option>
                                <option value="Mahasiswa" @if (old('pekerjaan') == 'Mahasiswa') selected @endif>Mahasiswa
                                </option>
                                <option value="PNS" @if (old('pekerjaan') == 'PNS') selected @endif>PNS</option>
                                <option value="Wiraswasta" @if (old('pekerjaan') == 'Wiraswasta') selected @endif>Wiraswasta
                                </option>
                                <option value="Wirausaha" @if (old('pekerjaan') == 'Wirausaha') selected @endif>Wirausaha
                                </option>
                                <option value="Lainnya" @if (old('pekerjaan') == 'Lainnya') selected @endif>Lainnya
                                </option>
                            </select>
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="domisili" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Keterangan Domisili <span
                                    class="font-bold text-rose-500">*</span></label>
                            <select name="domisili" id="domisili" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="Di Dalam Wilayah Pelayanan"
                                    @if (old('domisili') == 'Di Dalam Wilayah Pelayanan') selected @endif>Di Dalam Wilayah Pelayanan</option>
                                <option value="Di Luar Wilayah Pelayanan"
                                    @if (old('domisili') == 'Di Luar Wilayah Pelayanan') selected @endif>Di Luar Wilayah Pelayanan</option>
                            </select>
                        </div>
                    </div>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="nama_ayah" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Ayah <span class="font-bold text-rose-500">*</span></label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                                placeholder="Masukkan Nama Ayah" value="{{ old('nama_ayah') }}">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="nama_ibu" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Nama Ibu <span class="font-bold text-rose-500">*</span></label>
                            <input type="text" name="nama_ibu" id="nama_ibu" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6"
                                placeholder="Masukkan Nama Ibu" value="{{ old('nama_ibu') }}">
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <label for="keterangan_tinggal" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Keterangan Tinggal <span
                                    class="font-bold text-rose-500">*</span></label>
                            <select name="keterangan_tinggal" id="keterangan_tinggal" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="Bersama Orang Tua" @if (old('keterangan_tinggal') == 'Bersama Orang Tua') selected @endif>
                                    Bersama Orang Tua</option>
                                <option value="Rumah Keluarga" @if (old('keterangan_tinggal') == 'Rumah Keluarga') selected @endif>Rumah
                                    Keluarga</option>
                                <option value="Kos-kosan" @if (old('keterangan_tinggal') == 'Kos-kosan') selected @endif>Kos-kosan
                                </option>
                                <option value="Asrama" @if (old('keterangan_tinggal') == 'Asrama') selected @endif>Asrama</option>
                            </select>
                        </div>
                    </div>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full lg:w-8/12">
                            <label for="wilayah" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Wilayah Kelompok <span class="font-bold text-rose-500">*</span></label>
                            <div class="text-[#a1acb8]">Keterangan Wilayah Kelompok
                                <div>
                                    - Kelompok 1 (Wilayah Kelompok 1,8,9)
                                    (Sekitar Daerah Depan Telkomas & Luar Telkomas)
                                </div>
                                <div>
                                    - Kelompok 2 (Wilayah Kelompok 2,3,4,5,6,7)
                                    (Daerah Telkomas)
                                </div>
                            </div>
                            <select name="wilayah" id="wilayah" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6">
                                <option value="1" @if (old('wilayah') == '1') selected @endif>Kelompok 1
                                </option>
                                <option value="2" @if (old('wilayah') == '2') selected @endif>Kelompok 2
                                </option>
                            </select>
                        </div>
                        <div class="shrink-0 px-3 w-full lg:w-4/12">
                            <div class="mb-6">
                                <label for="kaderisasi" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Kaderisasi <span
                                        class="font-bold text-rose-500">*</span></label><br>
                                <div id="checkbox-error" class="text-[#ff3e1d]" style="display: none">
                                    Minimal pilih satu kaderisasi
                                </div>
                                @foreach ($pelatihan as $index => $item)
                                    <div class="mb-1 flex items-center gap-2">
                                        <input class="size-4 accent-sky-600" type="checkbox" name="kaderisasi[]"
                                            id="{{ $item->id }}" value="{{ $item->id }}"
                                            data-index="{{ $loop->index }}"
                                            @if ($loop->first) checked @endif
                                            @if (in_array($item->id, old('kaderisasi', []))) checked @endif>
                                        <label class="inline-block"
                                            for="{{ $item->id }}">{{ $item->nama_pelatihan }}</label>
                                        <input type="number" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 w-full" name="tahun[]"
                                            id="tahun_{{ $item->id }}" style="display: none"
                                            placeholder="Tahun Mengikuti {{ $item->nama_pelatihan }}"
                                            value="{{ old('tahun.' . $loop->index) }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <input type="text" name="keterangan_anggota" id="keterangan_anggota" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100 disabled:bg-slate-100 mb-6 hidden"
                        placeholder="Masukkan keterangan_anggota anda" value="Aktif">
                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-sky-600 text-white shadow-lg shadow-sky-600/30 hover:bg-sky-700">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var noCheckbox = document.getElementById('1');
            var lkpdCheckbox = document.getElementById('2');
            var lkplCheckbox = document.getElementById('3');
            var lkpaCheckbox = document.getElementById('4');
            var totCheckbox = document.getElementById('5');

            var tahunLkpdInput = document.getElementById('tahun_2');
            var tahunLkplInput = document.getElementById('tahun_3');
            var tahunLkpaInput = document.getElementById('tahun_4');
            var tahunTotInput = document.getElementById('tahun_5');

            noCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    lkpdCheckbox.checked = false;
                    lkplCheckbox.checked = false;
                    lkpaCheckbox.checked = false;
                    totCheckbox.checked = false;
                    tahunLkpdInput.style.display = 'none';
                    tahunLkplInput.style.display = 'none';
                    tahunLkpaInput.style.display = 'none';
                    tahunTotInput.style.display = 'none';
                }
            });


            lkpdCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    noCheckbox.checked = false;
                    tahunLkpdInput.style.display = 'block';
                } else {
                    tahunLkpdInput.style.display = 'none';
                }
            });

            lkplCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    noCheckbox.checked = false;
                    lkpdCheckbox.checked = true;
                    tahunLkpdInput.style.display = 'block';
                    tahunLkplInput.style.display = 'block';
                } else {
                    lkpdCheckbox.checked = false;
                    tahunLkpdInput.style.display = 'none';
                    tahunLkplInput.style.display = 'none';
                }
            });

            lkpaCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    noCheckbox.checked = false;
                    lkpdCheckbox.checked = true;
                    lkplCheckbox.checked = true;
                    tahunLkplInput.style.display = 'block';
                    tahunLkpdInput.style.display = 'block';
                    tahunLkpaInput.style.display = 'block';
                } else {
                    lkpdCheckbox.checked = false;
                    lkplCheckbox.checked = false;
                    tahunLkplInput.style.display = 'none';
                    tahunLkpdInput.style.display = 'none';
                    tahunLkpaInput.style.display = 'none';
                }

                // Tambahkan logika tambahan untuk data 3 (lkpaCheckbox dan tahunLkpaInput)
                if (!lkpaCheckbox.checked) {
                    lkpaCheckbox.value = ''; // Menghapus nilai yang akan dikirim ke controller
                    tahunLkpaInput.value = ''; // Menghapus nilai tahun yang akan dikirim ke controller
                }
            });

            totCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    noCheckbox.checked = false;
                    lkpdCheckbox.checked = true;
                    lkplCheckbox.checked = true;
                    tahunLkplInput.style.display = 'block';
                    tahunLkpdInput.style.display = 'block';
                    tahunTotInput.style.display = 'block';
                } else {
                    lkpdCheckbox.checked = false;
                    lkplCheckbox.checked = false;
                    tahunLkplInput.style.display = 'none';
                    tahunLkpdInput.style.display = 'none';
                    tahunTotInput.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        const checkboxes = document.querySelectorAll('input[name="kaderisasi[]"]');
        const checkboxError = document.getElementById('checkbox-error');

        function validateCheckboxes() {
            let checkedCount = 0;
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });

            if (checkedCount === 0) {
                checkboxError.style.display = 'block';
                return false;
            } else {
                checkboxError.style.display = 'none';
                return true;
            }
        }

        // Mendaftarkan event listener pada setiap checkbox
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', validateCheckboxes);
        });

        // Validasi saat mengirimkan formulir
        document.querySelector('form').addEventListener('submit', (e) => {
            if (!validateCheckboxes()) {
                e.preventDefault(); // Menghentikan pengiriman formulir jika validasi gagal
            }
        });
    </script>
@endpush
