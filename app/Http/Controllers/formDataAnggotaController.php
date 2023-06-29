<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataAnggotaRequest;
use App\Models\DataAnggota;
use App\Models\Kaderisasi;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class formDataAnggotaController extends Controller
{
    public function index()
    {
        $pelatihan = Pelatihan::all();

        return view('pages.formAnggota', [
            'pelatihan' => $pelatihan
        ]);
    }

    public function store(DataAnggotaRequest $request)
    {
        $data = $request->all();
        $tahun = [];

        // Lakukan validasi ketik isi array dari tahun ada yang null maka lanjutkan saja ke index selanjutnya
        foreach ($data['tahun'] as  $value) {
            if ($value == null) {
                continue;
            }
            array_push($tahun, $value);
        }

        $dataAnggota = DataAnggota::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'alamat' => $data['alamat'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'golongan_darah' => $data['golongan_darah'],
            'rhesus' => $data['rhesus'],
            'bersedia' => $data['bersedia'],
            'status' => $data['status'],
            'keanggotaan' => $data['keanggotaan'],
            'pendidikan' => $data['pendidikan'],
            'pekerjaan' => $data['pekerjaan'],
            'domisili' => $data['domisili'],
            'nama_ayah' => $data['nama_ayah'],
            'nama_ibu' => $data['nama_ibu'],
            'keterangan_tinggal' => $data['keterangan_tinggal'],
            'wilayah' => $data['wilayah'],
        ]);

        $kaderisasi = $data['kaderisasi'];
        $pelatihan = [];

        if ($kaderisasi[0] === "1") {
            foreach ($kaderisasi as $index => $item) {
                $dataPelatihan = [
                    'tahun' => 0,
                    'anggota_id' => $dataAnggota->id,
                    'pelatihan_id' => $item, // Menggunakan nilai dari $kaderisasi langsung
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $pelatihan[] = $dataPelatihan;
            }
        } else {
            foreach ($tahun as $index => $item) {
                $dataPelatihan = [
                    'tahun' => $item,
                    'anggota_id' => $dataAnggota->id,
                    'pelatihan_id' => $kaderisasi[$index], // Menggunakan indeks loop untuk mengakses nilai yang sesuai dari $kaderisasi
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $pelatihan[] = $dataPelatihan;
            }
        }
        Kaderisasi::insert($pelatihan);

        return redirect()->route('home');
    }
}
