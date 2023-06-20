@extends('layouts.admin')

@section('title')
    Admin Dashboard
@endsection

@section('content')
    <div class="pages">
        <h2 class="text-center">DATA STATISTIK</h2>

        <div class="dashboard">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="grafik-keuangan">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Grafik Anggota</h5>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-6 mb-4">
                                            <select name="filter" id="filter" class="form-select"
                                                onchange="updateChart()">
                                                <option value="jenis_kelamin">Jenis Kelamin</option>
                                                <option value="pendidikan">Pendidikan</option>
                                                <option value="pekerjaan">Pekerjaan</option>
                                                <option value="keterangan_tinggal">Keterangan Tinggal</option>
                                                <option value="keanggotaan">Keanggotaan</option>
                                                <option value="kaderisasi">Kaderisasi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="grafik-keuangan">
                        <div class="card align-items-center">
                            <div class="card-body w-75 ">
                                <h5 class="text-center flex-grow-1">Chart Pie Anggota PPGT JSK</h5>
                                <div class="mt-3">
                                    <div class="mb-4 text-center">
                                        <select name="pieFilter" id="pieFilter" class="form-select" onchange="updatePie()">
                                            <option value="domisili">Domisili</option>
                                            <option value="wilayah">Wilayah Pelayanan</option>
                                            <option value="golongan_darah">Golongan Darah</option>
                                            <option value="status">Status</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <canvas id="pieChart" width="300" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
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
