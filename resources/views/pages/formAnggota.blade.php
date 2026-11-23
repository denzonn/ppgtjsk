@extends('layouts.app')

@section('title')
    Form Database - PPGT Jemaat Satria Kasih
@endsection

@php
    $label = 'mb-2 inline-block';
    $star = 'font-bold text-red-600';
    $field = 'mb-6 block w-full rounded-md border border-admin-border bg-white px-3.5 py-[7px] text-[0.9375rem] leading-[1.53] text-admin-text outline-none transition placeholder:text-[#999] focus:border-admin focus:shadow-[0_0_0.25rem_0.05rem_rgba(105,108,255,0.1)]';
    $selects = [
        [
            'jenis_kelamin' => ['Jenis Kelamin', ['Laki-laki', 'Perempuan']],
            'golongan_darah' => ['Golongan Darah', ['A', 'B', 'AB', 'O', 'Tidak Tahu']],
            'rhesus' => ['Rhesus', ['+', '-']],
        ],
        [
            'bersedia' => ['Apakah Anda Bersedia Mendonor Darah?', ['Ya', 'Tidak']],
            'status' => ['Status', ['Menikah', 'Belum Menikah']],
            'keanggotaan' => ['Keanggotaan', ['SIDI' => 'SIDI', 'BAPTIS' => 'BAPTIS', 'BAPTIS DEWASA' => 'BAPTIS DEWASA', 'BELUM' => 'Belum']],
        ],
        [
            'pendidikan' => ['Pendidikan Terakhir', ['SD / Sederajat', 'SMP / Sederajat', 'SMA / Sederajat', 'D3 (Diploma)', 'S1 (Sarjana)', 'S2 (Magister)', 'S3 (Doktor)']],
            'pekerjaan' => ['Pekerjaan', ['Pelajar', 'Mahasiswa', 'PNS', 'Wiraswasta', 'Wirausaha', 'Lainnya']],
            'domisili' => ['Keterangan Domisili', ['Di Dalam Wilayah Pelayanan', 'Di Luar Wilayah Pelayanan']],
        ],
    ];
@endphp

@section('content')
    <section class="relative z-[2] mt-[100px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="mb-4 mt-12 flex flex-col items-center" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="mb-2 inline-block border-b-4 border-brand pb-[5px] text-center font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                    Form Pengisian Database</h2>
                <p class="mb-4 text-center text-gray-500">"Silahkan mengisi data diri anda!!."</p>
            </div>

            <div class="mb-[50px] py-2.5 pl-2.5 font-public text-admin-text md:p-5" data-aos="fade-up"
                data-aos-duration="2000">
                <div class="rounded-lg bg-white p-6 shadow-[0_2px_6px_0_rgba(67,89,113,0.12)]">
                    @if ($errors->any())
                        <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-4 text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('form-anggota-store') }}" method="POST" id="formDocument">
                        @csrf

                        <label for="nik" class="{{ $label }}">NIK <span class="{{ $star }}">*</span></label>
                        <input type="text" name="nik" id="nik" class="{{ $field }}" placeholder="Masukkan NIK anda"
                            required>

                        <div class="grid gap-x-6 lg:grid-cols-2">
                            <div>
                                <label for="nama" class="{{ $label }}">Nama <span class="{{ $star }}">*</span></label>
                                <input type="text" name="nama" id="nama" class="{{ $field }}"
                                    placeholder="Masukkan Nama Anda" required>
                            </div>
                            <div>
                                <label for="email" class="{{ $label }}">Email <span class="{{ $star }}">*</span></label>
                                <input type="email" name="email" id="email" class="{{ $field }}"
                                    placeholder="Masukkan Email Anda" required>
                            </div>
                            <div>
                                <label for="no_hp" class="{{ $label }}">No HP <span class="{{ $star }}">*</span></label>
                                <input type="number" name="no_hp" id="no_hp" class="{{ $field }}"
                                    placeholder="Masukkan No HP Anda" required>
                            </div>
                            <div>
                                <label for="tempat_lahir" class="{{ $label }}">Tempat Lahir <span
                                        class="{{ $star }}">*</span></label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="{{ $field }}"
                                    placeholder="Masukkan Tempat Lahir Anda" required>
                            </div>
                        </div>

                        <label for="tanggal_lahir" class="{{ $label }}">Tanggal Lahir <span
                                class="{{ $star }}">*</span></label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="{{ $field }}" required>

                        <label for="alamat" class="{{ $label }}">Alamat <span class="{{ $star }}">*</span></label>
                        <textarea name="alamat" id="alamat" cols="30" rows="5" class="{{ $field }}"
                            placeholder="Masukkan Alamat Anda" required></textarea>

                        @foreach ($selects as $row)
                            <div class="grid gap-x-6 lg:grid-cols-3">
                                @foreach ($row as $name => [$text, $options])
                                    <div>
                                        <label for="{{ $name }}" class="{{ $label }}">{{ $text }} <span
                                                class="{{ $star }}">*</span></label>
                                        <select name="{{ $name }}" id="{{ $name }}" class="{{ $field }}">
                                            @foreach ($options as $value => $option)
                                                <option value="{{ is_int($value) ? $option : $value }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="grid gap-x-6 lg:grid-cols-3">
                            <div>
                                <label for="nama_ayah" class="{{ $label }}">Nama Ayah <span
                                        class="{{ $star }}">*</span></label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="{{ $field }}"
                                    placeholder="Masukkan Nama Ayah" required>
                            </div>
                            <div>
                                <label for="nama_ibu" class="{{ $label }}">Nama Ibu <span
                                        class="{{ $star }}">*</span></label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="{{ $field }}"
                                    placeholder="Masukkan Nama Ibu" required>
                            </div>
                            <div>
                                <label for="keterangan_tinggal" class="{{ $label }}">Keterangan Tinggal <span
                                        class="{{ $star }}">*</span></label>
                                <select name="keterangan_tinggal" id="keterangan_tinggal" class="{{ $field }}">
                                    @foreach (['Bersama Orang Tua', 'Rumah Keluarga', 'Kos-kosan', 'Asrama'] as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid gap-x-6 lg:grid-cols-3">
                            <div class="lg:col-span-2">
                                <label for="wilayah" class="{{ $label }}">Wilayah Kelompok <span
                                        class="{{ $star }}">*</span></label>
                                <div class="mb-2 text-gray-500">Keterangan Wilayah Kelompok
                                    <div>- Kelompok 1 (Wilayah Kelompok 1,8,9) (Sekitar Daerah Depan Telkomas & Luar
                                        Telkomas)</div>
                                    <div>- Kelompok 2 (Wilayah Kelompok 2,3,4,5,6,7) (Daerah Telkomas)</div>
                                </div>
                                <select name="wilayah" id="wilayah" class="{{ $field }}">
                                    <option value="1">Kelompok 1</option>
                                    <option value="2">Kelompok 2</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="kaderisasi" class="{{ $label }}">Kaderisasi <span
                                        class="{{ $star }}">*</span></label>
                                <div id="checkbox-error" class="text-red-600" style="display: none">
                                    Minimal pilih satu kaderisasi
                                </div>
                                @foreach ($pelatihan as $item)
                                    <div class="mb-1">
                                        <label class="inline-flex items-center gap-2">
                                            <input type="checkbox" name="kaderisasi[]" id="{{ $item->id }}"
                                                value="{{ $item->id }}" data-index="{{ $loop->index }}"
                                                class="size-4 accent-admin" @if ($loop->first) checked @endif>
                                            {{ $item->nama_pelatihan }}
                                        </label>
                                        <input type="number" name="tahun[]" id="tahun_{{ $item->id }}"
                                            class="{{ $field }} mb-2!" style="display: none"
                                            placeholder="Tahun Mengikuti {{ $item->nama_pelatihan }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="keterangan_anggota" id="keterangan_anggota" value="Aktif">
                        <button type="submit"
                            class="w-full rounded bg-brand px-5 py-2.5 text-white hover:bg-brand-dark">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
