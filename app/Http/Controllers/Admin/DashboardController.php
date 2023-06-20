<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataAnggota;
use App\Models\Kaderisasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //Bar 
        //Ambil semua data laki-laki di anggota
        $laki = DataAnggota::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = DataAnggota::where('jenis_kelamin', 'Perempuan')->count();

        //Pendidikan
        $sd = DataAnggota::where('pendidikan', 'SD / Sederajat')->count();
        $smp = DataAnggota::where('pendidikan', 'SMP / Sederajat')->count();
        $sma = DataAnggota::where('pendidikan', 'SMA / Sederajat')->count();
        $d3 = DataAnggota::where('pendidikan', 'D3 (Diploma)')->count();
        $s1 = DataAnggota::where('pendidikan', 'S1 (Sarjana)')->count();
        $s2 = DataAnggota::where('pendidikan', 'S2 (Magister)')->count();
        $s3 = DataAnggota::where('pendidikan', 'S3 (Doktor)')->count();

        //Pekerjaan
        $pelajar = DataAnggota::where(
            'pekerjaan',
            'Pelajar'
        )->count();
        $mahasiswa = DataAnggota::where('pekerjaan', 'Mahasiswa')->count();
        $pns = DataAnggota::where('pekerjaan', 'PNS')->count();
        $wirausaha = DataAnggota::where('pekerjaan', 'Wirausaha')->count();
        $wiraswasta = DataAnggota::where('pekerjaan', 'Wiraswasta')->count();
        $lainnya = DataAnggota::where('pekerjaan', 'Lainnya')->count();

        // Keterangan Tinggal
        $orangTua = DataAnggota::where('keterangan_tinggal', 'Bersama Orang Tua')->count();
        $keluarga = DataAnggota::where('keterangan_tinggal', 'Rumah Keluarga')->count();
        $kos = DataAnggota::where('keterangan_tinggal', 'Kos-kosan')->count();
        $asrama = DataAnggota::where('keterangan_tinggal', 'Asrama')->count();

        // Keanggotaan
        $sidi = DataAnggota::where('keanggotaan', 'SIDI')->count();
        $baptis = DataAnggota::where('keanggotaan', 'BAPTIS')->count();
        $baptisDewasa = DataAnggota::where('keanggotaan', 'BAPTIS DEWASA')->count();
        $belum = DataAnggota::where('keanggotaan', 'BELUM')->count();

        // Kaderisasi
        $belumPernah = Kaderisasi::where('pelatihan_id', '1')->count();
        $lkpd = Kaderisasi::where('pelatihan_id', '2')->count();
        $lkpl = Kaderisasi::where('pelatihan_id', '3')->count();
        $lkpa = Kaderisasi::where('pelatihan_id', '4')->count();
        $tot = Kaderisasi::where('pelatihan_id', '5')->count();

        // Pie
        // Dalam wilayah
        $dalamWilayah = DataAnggota::where('domisili', 'Di Dalam Wilayah Pelayanan')->count();
        $luarWilayah = DataAnggota::where('domisili', 'Di Luar Wilayah Pelayanan')->count();

        // Wilayah 
        $kelompok1 = DataAnggota::where('wilayah', '1')->count();
        $kelompok2 = DataAnggota::where('wilayah', '2')->count();

        //Goldar
        $a = DataAnggota::where('golongan_darah', 'A')->count();
        $b = DataAnggota::where('golongan_darah', 'B')->count();
        $ab = DataAnggota::where('golongan_darah', 'AB')->count();
        $o = DataAnggota::where('golongan_darah', 'O')->count();
        $tidakTahu = DataAnggota::where('golongan_darah', 'Tidak Tahu')->count();

        //Status
        $menikah = DataAnggota::where('status', 'Menikah')->count();
        $belumMenikah = DataAnggota::where('status', 'Belum Menikah')->count();



        return view('pages.admin.dashboard.index', [
            'laki' => $laki,
            'perempuan' => $perempuan,
            'sd' => $sd,
            'smp' => $smp,
            'sma' => $sma,
            'd3' => $d3,
            's1' => $s1,
            's2' => $s2,
            's3' => $s3,
            'pelajar' => $pelajar,
            'mahasiswa' => $mahasiswa,
            'pns' => $pns,
            'wirausaha' => $wirausaha,
            'wiraswasta' => $wiraswasta,
            'lainnya' => $lainnya,
            'orangTua' => $orangTua,
            'keluarga' => $keluarga,
            'kos' => $kos,
            'asrama' => $asrama,
            'sidi' => $sidi,
            'baptis' => $baptis,
            'baptisDewasa' => $baptisDewasa,
            'belum' => $belum,
            'belumPernah' => $belumPernah,
            'lkpd' => $lkpd,
            'lkpl' => $lkpl,
            'lkpa' => $lkpa,
            'tot' => $tot,
            'dalamWilayah' => $dalamWilayah,
            'luarWilayah' => $luarWilayah,
            'kelompok1' => $kelompok1,
            'kelompok2' => $kelompok2,
            'a' => $a,
            'b' => $b,
            'ab' => $ab,
            'o' => $o,
            'tidakTahu' => $tidakTahu,
            'menikah' => $menikah,
            'belumMenikah' => $belumMenikah
        ]);
    }
}
