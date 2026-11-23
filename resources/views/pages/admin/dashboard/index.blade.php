@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@php
    $total = $laki + $perempuan;
    $hour = now()->hour;
    $greet = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam'));
@endphp

@section('content')
    {{-- Hero sapaan --}}
    <section class="relative mb-6 overflow-hidden rounded-3xl bg-linear-to-br from-indigo-600 via-violet-600 to-fuchsia-600 p-8 text-white shadow-xl shadow-indigo-500/30 md:p-10">
        <span class="absolute -right-20 -top-24 size-80 rounded-full bg-white/10"></span>
        <span class="absolute -bottom-32 right-40 size-72 rounded-full bg-fuchsia-300/20 blur-2xl"></span>
        <div class="relative flex flex-wrap items-end justify-between gap-6">
            <div>
                <p class="text-indigo-100">{{ $greet }},</p>
                <h1 class="text-3xl font-extrabold tracking-tight md:text-4xl">{{ Auth::user()->name ?? 'Admin' }} 👋</h1>
                <p class="mt-2 max-w-lg text-indigo-100">Ringkasan data anggota PPGT Jemaat Satria Kasih hari ini.</p>
            </div>
            <div class="rounded-2xl bg-white/15 px-6 py-4 text-center backdrop-blur">
                <p class="text-5xl font-black leading-none">{{ $total }}</p>
                <p class="mt-1 text-sm text-indigo-100">anggota terdaftar</p>
            </div>
        </div>
    </section>

    {{-- Statistik singkat --}}
    <section class="mb-6 grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach ([
            ['Laki-laki', $laki, 'bx-male', 'bg-blue-50 text-blue-600'],
            ['Perempuan', $perempuan, 'bx-female', 'bg-pink-50 text-pink-600'],
            ['Dalam wilayah', $dalamWilayah, 'bx-map-pin', 'bg-emerald-50 text-emerald-600'],
            ['Sudah menikah', $menikah, 'bx-heart', 'bg-amber-50 text-amber-600'],
        ] as [$label, $value, $icon, $tone])
            <div class="flex items-center gap-4 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-admin-border">
                <span class="grid size-12 shrink-0 place-items-center rounded-xl text-2xl {{ $tone }}"><i class="bx {{ $icon }}"></i></span>
                <div class="min-w-0">
                    <p class="text-2xl font-black text-admin-heading">{{ $value }}</p>
                    <p class="truncate text-sm text-slate-500">{{ $label }}</p>
                </div>
                @if ($total)
                    <span class="ml-auto text-xs font-bold text-slate-400">{{ round($value / $total * 100) }}%</span>
                @endif
            </div>
        @endforeach
    </section>

    {{-- Grafik --}}
    <section class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-admin-border">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h2 class="flex items-center gap-2 text-lg font-bold text-admin-heading"><i class="bx bx-bar-chart-alt-2 text-indigo-500"></i> Grafik Anggota</h2>
                <select name="filter" id="filter" onchange="updateChart()"
                    class="rounded-xl border-0 bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="jenis_kelamin">Jenis Kelamin</option>
                    <option value="pendidikan">Pendidikan</option>
                    <option value="pekerjaan">Pekerjaan</option>
                    <option value="keterangan_tinggal">Keterangan Tinggal</option>
                    <option value="keanggotaan">Keanggotaan</option>
                    <option value="kaderisasi">Kaderisasi</option>
                </select>
            </div>
            <canvas id="myChart"></canvas>
        </div>
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-admin-border">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h2 class="flex items-center gap-2 text-lg font-bold text-admin-heading"><i class="bx bx-pie-chart-alt-2 text-fuchsia-500"></i> Komposisi</h2>
                <select name="pieFilter" id="pieFilter" onchange="updatePie()"
                    class="rounded-xl border-0 bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 outline-none focus:ring-2 focus:ring-fuchsia-400">
                    <option value="domisili">Domisili</option>
                    <option value="wilayah">Wilayah Pelayanan</option>
                    <option value="golongan_darah">Golongan Darah</option>
                    <option value="status">Status</option>
                </select>
            </div>
            <div class="mx-auto max-w-xs">
                <canvas id="pieChart" width="300" height="300"></canvas>
            </div>
        </div>
    </section>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let myChart;

        // Fungsi untuk memperbarui grafik berdasarkan opsi yang dipilih
        function updateChart() {
            const filter = document.getElementById('filter').value;
            const chartData = [];

            if (myChart) {
                myChart.destroy(); // Menghancurkan grafik sebelum membuat yang baru
            }

            if (filter === 'jenis_kelamin') {
                labelsData = ['Laki-laki', 'Perempuan'];

                chartData.push({
                    label: 'Jenis Kelamin',
                    data: [{{ $laki }}, {{ $perempuan }}],
                    backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                    borderWidth: 1
                });
            } else if (filter === 'pendidikan') {
                labelsData = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];

                chartData.push({
                    label: 'Pendidikan Terakhir',
                    data: [{{ $sd }}, {{ $smp }}, {{ $sma }}, {{ $d3 }},
                        {{ $s1 }}, {{ $s2 }}, {{ $s3 }}
                    ],
                    backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(201, 203, 207, 0.5)',
                        'rgba(255, 205, 86, 0.5)'
                    ],
                    borderWidth: 1
                });
            } else if (filter === 'pekerjaan') {
                labelsData = ['Pelajar', 'Mahasiswa', 'PNS', 'Swasta', 'Wiraswasta', 'Lainnya'];

                chartData.push({
                    label: 'Pekerjaan',
                    data: [{{ $pelajar }}, {{ $mahasiswa }}, {{ $pns }}, {{ $wirausaha }},
                        {{ $wiraswasta }}, {{ $lainnya }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(201, 203, 207, 0.5)',
                        'rgba(255, 205, 86, 0.5)'
                    ],
                    borderWidth: 1
                });
            } else if (filter === 'keterangan_tinggal') {
                labelsData = ['Bersama Orang Tua', 'Rumah Keluarga', 'Kos-kosan', 'Asrama'];

                chartData.push({
                    label: 'Pekerjaan',
                    data: [
                        {{ $orangTua }}, {{ $keluarga }}, {{ $kos }}, {{ $asrama }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(201, 203, 207, 0.5)',
                        'rgba(255, 205, 86, 0.5)'
                    ],
                    borderWidth: 1
                });
            } else if (filter === 'keanggotaan') {
                labelsData = ['Sidi', 'Baptis', 'Baptis Dewasa', 'Belum'];

                chartData.push({
                    label: 'Keanggotaan',
                    data: [
                        {{ $sidi }}, {{ $baptis }}, {{ $baptisDewasa }}, {{ $belum }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(201, 203, 207, 0.5)',
                        'rgba(255, 205, 86, 0.5)'
                    ],
                    borderWidth: 1
                });
            } else if (filter === 'kaderisasi') {
                labelsData = ['Belum Pernah', 'LKPD', 'LKPL', 'LKPA', 'TOT'];

                chartData.push({
                    label: 'Kaderisasi',
                    data: [
                        {{ $belumPernah }}, {{ $lkpd }}, {{ $lkpl }}, {{ $lkpa }},
                        {{ $tot }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(201, 203, 207, 0.5)',
                        'rgba(255, 205, 86, 0.5)'
                    ],
                    borderWidth: 1
                });
            }

            // Perbarui grafik dengan data yang baru
            const ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelsData,
                    datasets: chartData
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            ticks: {
                                autoSkip: false, // Memastikan semua label ditampilkan
                                maxRotation: 90, // Mengatur rotasi maksimum label menjadi 90 derajat
                                minRotation: 0 // Mengatur rotasi minimum label menjadi 0 derajat
                            }
                        }
                    },
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    borderRadius: 5,
                }
            });
        }


        // Panggil fungsi updateChart saat halaman dimuat
        document.addEventListener('DOMContentLoaded', updateChart);
    </script>

    <script>
        let pieChart;

        // Fungsi untuk memperbarui grafik berdasarkan opsi yang dipilih
        function updatePie() {
            const pieFilter = document.getElementById('pieFilter').value;
            const chartPie = [];

            if (pieChart) {
                pieChart.destroy(); // Menghancurkan grafik sebelum membuat yang baru
            }

            if (pieFilter === 'domisili') {
                labelsPie = ['Dalam Wilayah Pelayanan', 'Luar Wilayah Pelayanan'];

                chartPie.push({
                    label: 'Domisili',
                    data: [{{ $dalamWilayah }}, {{ $luarWilayah }}],
                    backgroundColor: ['rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)'],
                    hoverOffset: 4
                });
            } else if (pieFilter === 'wilayah') {
                labelsPie = ['Kelompok 1', 'Kelompok 2'];

                chartPie.push({
                    label: 'Wilayah Pelayanan',
                    data: [{{ $kelompok1 }}, {{ $kelompok2 }}],
                    backgroundColor: ['rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'],
                    hoverOffset: 4
                });
            } else if (pieFilter === 'golongan_darah') {
                labelsPie = ['A', 'B', 'AB', 'O', 'Tidak Tahu'];

                chartPie.push({
                    label: 'Golongan Darah',
                    data: [
                        {{ $a }}, {{ $b }}, {{ $ab }}, {{ $o }},
                        {{ $tidakTahu }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(75, 192, 192, 0.5)', 'rgba(201, 203, 207, 0.5)'
                    ],
                    hoverOffset: 4
                });
            } else if (pieFilter === 'status') {
                labelsPie = ['Menikah', 'Belum Menikah'];

                chartPie.push({
                    label: 'Status',
                    data: [
                        {{ $menikah }}, {{ $belumMenikah }}
                    ],
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    hoverOffset: 4
                });
            }

            // Perbarui grafik dengan data yang baru
            const ctx = document.getElementById('pieChart').getContext('2d');
            pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labelsPie,
                    datasets: chartPie
                },
                options: {
                    animation: {
                        animateRotate: true, // Aktifkan animasi rotasi
                        animateScale: true, // Aktifkan animasi skala
                    }
                }
            });
        }

        // Panggil fungsi updatePie saat halaman dimuat
        document.addEventListener('DOMContentLoaded', updatePie);
    </script>
@endpush
