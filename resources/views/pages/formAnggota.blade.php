@extends('layouts.app')

@section('title')
    Form Database - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <!-- Gallery -->
    <section class="gallery">
        <div class="container">
            <div class="content mt-5 mb-3" data-aos="fade-up" data-aos-duration="1000">
                <h2>Form Pengisian Database</h2>
                <p class="text-muted text-center">
                    "Silahkan mengisi data diri anda!!."
                </p>
            </div>

            <div class="form-anggota" data-aos="fade-up" data-aos-duration="2000">
                <div class="row">
                    <div class="pages">
                        <div class="card">
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

                                <form action="{{ route('form-anggota-store') }}" method="POST" id="formDocument">
                                    @csrf

                                    <label for="nik" class="mb-2">NIK <span class="star">*</span></label>
                                    <input type="text" name="nik" id="nik" class="form-control mb-4"
                                        placeholder="Masukkan NIK anda" required>

                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="nama" class="mb-2">Nama <span class="star">*</span></label>
                                            <input type="text" name="nama" id="nama" class="form-control mb-4"
                                                placeholder="Masukkan Nama Anda" required>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="email" class="mb-2">Email <span class="star">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control mb-4"
                                                placeholder="Masukkan Email Anda" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="no_hp" class="mb-2">No HP <span class="star">*</span></label>
                                            <input type="number" name="no_hp" id="no_hp" class="form-control mb-4"
                                                placeholder="Masukkan No HP Anda" required>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="tempat_lahir" class="mb-2">Tempat Lahir <span
                                                    class="star">*</span></label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                class="form-control mb-4" placeholder="Masukkan Tempat Lahir Anda" required>
                                        </div>
                                    </div>

                                    <label for="tanggal_lahir" class="mb-2">Tanggal Lahir <span
                                            class="star">*</span></label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control mb-4"
                                        required>

                                    <label for="alamat" class="mb-2">Alamat <span class="star">*</span></label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control mb-4"
                                        placeholder="Masukkan Alamat Anda" required></textarea>


                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <label for="jenis_kelamin" class="mb-2">Jenis Kelamin <span
                                                    class="star">*</span></label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control mb-4">
                                                <option value="Laki-laki">
                                                    Laki-laki
                                                </option>
                                                <option value="Perempuan">
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="golongan_darah" class="mb-2">Golongan Darah <span
                                                    class="star">*</span></label>
                                            <select name="golongan_darah" id="golongan_darah" class="form-control mb-4">
                                                <option value="A">A
                                                </option>
                                                <option value="B">B
                                                </option>
                                                <option value="AB">AB
                                                </option>
                                                <option value="O">O
                                                </option>
                                                <option value="Tidak Tahu">Tidak Tahu
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="rhesus" class="mb-2">Rhesus <span
                                                    class="star">*</span></label>
                                            <select name="rhesus" id="rhesus" class="form-control mb-4">
                                                <option value="+">+
                                                </option>
                                                <option value="-">-
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <label for="bersedia" class="mb-2">Apakah Anda Bersedia Mendonor Darah?
                                                <span class="star">*</span></label>
                                            <select name="bersedia" id="bersedia" class="form-control mb-4">
                                                <option value="Ya">
                                                    Ya</option>
                                                <option value="Tidak">
                                                    Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="status" class="mb-2">Status <span
                                                    class="star">*</span></label>
                                            <select name="status" id="status" class="form-control mb-4">
                                                <option value="Menikah">
                                                    Menikah
                                                </option>
                                                <option value="Belum Menikah">Belum
                                                    Menikah</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="keanggotaan" class="mb-2">Keanggotaan <span
                                                    class="star">*</span></label>
                                            <select name="keanggotaan" id="keanggotaan" class="form-control mb-4">
                                                <option value="SIDI">
                                                    SIDI</option>
                                                <option value="BAPTIS">
                                                    BAPTIS</option>
                                                <option value="BAPTIS DEWASA">BAPTIS
                                                    DEWASA</option>
                                                <option value="BELUM">
                                                    Belum</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <label for="pendidikan" class="mb-2">Pendidikan Terakhir <span
                                                    class="star">*</span></label>
                                            <select name="pendidikan" id="pendidikan" class="form-control mb-4">
                                                <option value="SD / Sederajat">SD /
                                                    Sederajat</option>
                                                <option value="SMP / Sederajat">SMP /
                                                    Sederajat</option>
                                                <option value="SMA / Sederajat">SMA /
                                                    Sederajat</option>
                                                <option value="D3 (Diploma)">D3
                                                    (Diploma)</option>
                                                <option value="S1 (Sarjana)">S1
                                                    (Sarjana)</option>
                                                <option value="S2 (Magister)">S2
                                                    (Magister)</option>
                                                <option value="S3 (Doktor)">S3 (Doktor)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="pekerjaan" class="mb-2">Pekerjaan <span
                                                    class="star">*</span></label>
                                            <select name="pekerjaan" id="pekerjaan" class="form-control mb-4">
                                                <option value="Pelajar">Pelajar
                                                </option>
                                                <option value="Mahasiswa">Mahasiswa
                                                </option>
                                                <option value="PNS">
                                                    PNS</option>
                                                <option value="Wiraswasta">Wiraswasta
                                                </option>
                                                <option value="Wirausaha">Wirausaha
                                                </option>
                                                <option value="Lainnya">Lainnya
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="domisili" class="mb-2">Keterangan Domisili <span
                                                    class="star">*</span></label>
                                            <select name="domisili" id="domisili" class="form-control mb-4">
                                                <option value="Di Dalam Wilayah Pelayanan">Di Dalam Wilayah
                                                    Pelayanan</option>
                                                <option value="Di Luar Wilayah Pelayanan">Di Luar Wilayah
                                                    Pelayanan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <label for="nama_ayah" class="mb-2">Nama Ayah <span
                                                    class="star">*</span></label>
                                            <input type="text" name="nama_ayah" id="nama_ayah"
                                                class="form-control mb-4" placeholder="Masukkan Nama Ayah" required>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="nama_ibu" class="mb-2">Nama Ibu <span
                                                    class="star">*</span></label>
                                            <input type="text" name="nama_ibu" id="nama_ibu"
                                                class="form-control mb-4" placeholder="Masukkan Nama Ibu" required>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="keterangan_tinggal" class="mb-2">Keterangan Tinggal <span
                                                    class="star">*</span></label>
                                            <select name="keterangan_tinggal" id="keterangan_tinggal"
                                                class="form-control mb-4">
                                                <option value="Bersama Orang Tua">
                                                    Bersama Orang Tua</option>
                                                <option value="Rumah Keluarga">Rumah
                                                    Keluarga</option>
                                                <option value="Kos-kosan">Kos-kosan
                                                </option>
                                                <option value="Asrama">
                                                    Asrama</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-lg-8">
                                            <label for="wilayah" class="mb-2">Wilayah Kelompok <span
                                                    class="star">*</span></label>
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
                                                <option value="1">
                                                    Kelompok 1
                                                </option>
                                                <option value="2">
                                                    Kelompok 2
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group mb-4">
                                                <label for="kaderisasi" class="mb-2">Kaderisasi <span
                                                        class="star">*</span></label><br>
                                                <div id="checkbox-error" class="text-danger" style="display: none">
                                                    Minimal pilih satu kaderisasi
                                                </div>
                                                @foreach ($pelatihan as $index => $item)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kaderisasi[]" id="{{ $item->id }}"
                                                            value="{{ $item->id }}" data-index="{{ $loop->index }}"
                                                            @if ($loop->first) checked @endif>
                                                        <label class="form-check-label"
                                                            for="{{ $item->id }}">{{ $item->nama_pelatihan }}</label>
                                                        <input type="number" class="form-control w-lg-25 w-100"
                                                            name="tahun[]" id="tahun_{{ $item->id }}"
                                                            style="display: none"
                                                            placeholder="Tahun Mengikuti {{ $item->nama_pelatihan }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="keterangan_anggota" id="keterangan_anggota"
                                        class="form-control mb-4 d-none" placeholder="Masukkan keterangan_anggota anda"
                                        value="Aktif">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery -->
@endsection


@push('addon-script')
    <!-- Pages -->

    <script>
        // Function untuk menampilkan halaman yang dipilih
        function showPage(pageId) {
            // Menghapus class "active" dari semua halaman
            var pages = document.getElementsByClassName('page')
            for (var i = 0; i < pages.length; i++) {
                pages[i].classList.remove('active')
            }
            // Menambahkan class "active" ke halaman yang dipilih
            var page = document.getElementById(pageId)
            page.classList.add('active')

            AOS.init();
        }
    </script>
    <!-- Pages -->

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
        $('form').submit(function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: new FormData(form[0]),
                contentType: false,
                processData: false,
                success: function() {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data Anda Berhasil Di Daftar',
                        icon: 'success',
                    });
                    setTimeout(() => {
                        window.location.href = "{{ route('home') }}";
                    }, 2000); // 2000 ms = 2 detik
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: xhr.responseJSON.message,
                        icon: 'error',
                    });
                }
            });
        });
    </script>
@endpush
