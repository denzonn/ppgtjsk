@extends('layouts.admin')

@section('title')
    Admin Data Anggota
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Tambahkan Anggota</h4>
            </div>
            <div class="card-body dataAnggota">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('data-anggota.store') }}" method="POST">
                    @csrf

                    <label for="nik" class="mb-2">NIK <span class="star">*</span></label>
                    <input type="text" name="nik" id="nik" class="form-control mb-4"
                        placeholder="Masukkan NIK anda">

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="nama" class="mb-2">Nama <span class="star">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control mb-4"
                                placeholder="Masukkan Nama Anda">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="email" class="mb-2">Email <span class="star">*</span></label>
                            <input type="email" name="email" id="email" class="form-control mb-4"
                                placeholder="Masukkan Email Anda">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="no_hp" class="mb-2">No HP <span class="star">*</span></label>
                            <input type="number" name="no_hp" id="no_hp" class="form-control mb-4"
                                placeholder="Masukkan No HP Anda">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="tempat_lahir" class="mb-2">Tempat Lahir <span class="star">*</span></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control mb-4"
                                placeholder="Masukkan Tempat Lahir Anda">
                        </div>
                    </div>

                    <label for="tanggal_lahir" class="mb-2">Tanggal Lahir <span class="star">*</span></label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control mb-4">

                    <label for="alamat" class="mb-2">Alamat <span class="star">*</span></label>
                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control mb-4"
                        placeholder="Masukkan Alamat Anda"></textarea>


                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <label for="jenis_kelamin" class="mb-2">Jenis Kelamin <span class="star">*</span></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control mb-4">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="golongan_darah" class="mb-2">Golongan Darah <span class="star">*</span></label>
                            <select name="golongan_darah" id="golongan_darah" class="form-control mb-4">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                                <option value="Tidak Tahu">Tidak Tahu</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="rhesus" class="mb-2">Rhesus <span class="star">*</span></label>
                            <select name="rhesus" id="rhesus" class="form-control mb-4">
                                <option value="+">+</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <label for="bersedia" class="mb-2">Apakah Anda Bersedia Mendonor Darah? <span
                                    class="star">*</span></label>
                            <select name="bersedia" id="bersedia" class="form-control mb-4">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="status" class="mb-2">Status <span class="star">*</span></label>
                            <select name="status" id="status" class="form-control mb-4">
                                <option value="Menikah">Menikah</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="keanggotaan" class="mb-2">Keanggotaan <span class="star">*</span></label>
                            <select name="keanggotaan" id="keanggotaan" class="form-control mb-4">
                                <option value="SIDI">SIDI</option>
                                <option value="BAPTIS">BAPTIS</option>
                                <option value="BAPTIS DEWASA">BAPTIS DEWASA</option>
                                <option value="BELUM">Belum</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <label for="pendidikan" class="mb-2">Pendidikan Terakhir <span
                                    class="star">*</span></label>
                            <select name="pendidikan" id="pendidikan" class="form-control mb-4">
                                <option value="SD / Sederajat">SD / Sederajat</option>
                                <option value="SMP / Sederajat">SMP / Sederajat</option>
                                <option value="SMP / Sederajat">SMA / Sederajat</option>
                                <option value="D3 (Diploma)">D3 (Diploma)</option>
                                <option value="S1 (Sarjana)">S1 (Sarjana)</option>
                                <option value="S2 (Magister)">S2 (Magister)</option>
                                <option value="S3 (Doktor)">S3 (Doktor)</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="pekerjaan" class="mb-2">Pekerjaan <span class="star">*</span></label>
                            <select name="pekerjaan" id="pekerjaan" class="form-control mb-4">
                                <option value="Pelajar">Pelajar</option>
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="PNS">PNS</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Wirausaha">Wirausaha</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="domisili" class="mb-2">Keterangan Domisili <span
                                    class="star">*</span></label>
                            <select name="domisili" id="domisili" class="form-control mb-4">
                                <option value="Di Dalam Wilayah Pelayanan">Di Dalam Wilayah Pelayanan</option>
                                <option value="Di Luar Wilayah Pelayanan">Di Luar Wilayah Pelayanan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <label for="nama_ayah" class="mb-2">Nama Ayah <span class="star">*</span></label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control mb-4"
                                placeholder="Masukkan Nama Ayah">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="nama_ibu" class="mb-2">Nama Ibu <span class="star">*</span></label>
                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control mb-4"
                                placeholder="Masukkan Nama Ibu">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="keterangan_tinggal" class="mb-2">Keterangan Tinggal <span
                                    class="star">*</span></label>
                            <select name="keterangan_tinggal" id="keterangan_tinggal" class="form-control mb-4">
                                <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                                <option value="Rumah Keluarga">Rumah Keluarga</option>
                                <option value="Kos-kosan">Kos-kosan</option>
                                <option value="Asrama">Asrama</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <label for="wilayah" class="mb-2">Wilayah Kelompok <span class="star">*</span></label>
                            <div class="text-muted">Keterangan Wilayah Kelompok
                                <div>
                                    - Kelompok 1 (Wilayah Kelompok 1,8,9)
                                    (Sekitar Daerah Depan Telkomas & Luar Telkomas)
                                </div>
                                <div>
                                    - Kelompok 2 (Wilayah Kelompok 2,3,4,5,6,7)
                                    (Daerah Telkomas)
                                </div>
                            </div>
                            <select name="wilayah" id="wilayah" class="form-control mb-4">
                                <option value="1">Kelompok 1</option>
                                <option value="2">Kelompok 2</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group mb-4">
                                <label for="kaderisasi" class="mb-2">Kaderisasi <span
                                        class="star">*</span></label><br>
                                @foreach ($pelatihan as $index => $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kaderisasi[]"
                                            id="{{ $item->id }}" value="{{ $item->id }}"
                                            data-index="{{ $loop->index }}">
                                        <label class="form-check-label"
                                            for="{{ $item->id }}">{{ $item->nama_pelatihan }}</label>
                                        <input type="number" class="form-control w-lg-25 w-100" name="tahun[]"
                                            id="tahun_{{ $item->id }}" style="display: none"
                                            placeholder="Tahun Mengikuti {{ $item->nama_pelatihan }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block w-100">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lkpdCheckbox = document.getElementById('1');
            var lkplCheckbox = document.getElementById('2');
            var lkpaCheckbox = document.getElementById('3');
            var totCheckbox = document.getElementById('4');

            var tahunLkpdInput = document.getElementById('tahun_1');
            var tahunLkplInput = document.getElementById('tahun_2');
            var tahunLkpaInput = document.getElementById('tahun_3');
            var tahunTotInput = document.getElementById('tahun_4');


            lkpdCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    tahunLkpdInput.style.display = 'block';
                } else {
                    tahunLkpdInput.style.display = 'none';
                }
            });

            lkplCheckbox.addEventListener('change', function() {
                if (this.checked) {
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
@endpush
