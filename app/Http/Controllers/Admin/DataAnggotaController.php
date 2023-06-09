<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataAnggotaRequest;
use App\Models\DataAnggota;
use App\Models\Kaderisasi;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class DataAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = DataAnggota::all();

        return view('pages.admin.anggota.index', [
            'anggota' => $anggota,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelatihan = Pelatihan::all();

        return view('pages.admin.anggota.create', [
            'pelatihan' => $pelatihan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('data-anggota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = DataAnggota::findOrFail($id);

        //Jenis kelamin
        $jenis_kelamin_database = $anggota->jenis_kelamin;
        $jenis_kelamin_options = ['Laki-laki', 'Perempuan'];

        // Menghapus jenis kelamin dari database dari opsi yang akan ditampilkan
        $jenis_kelamin_options = array_diff($jenis_kelamin_options, [$jenis_kelamin_database]);


        // Golongan darah
        $golongan_darah_database = $anggota->golongan_darah;
        $golongan_darah_options = ['A', 'B', 'AB', 'O', 'Tidak Tahu'];

        // Menghapus golongan darah dari database dari opsi yang akan ditampilkan
        $golongan_darah_options = array_diff($golongan_darah_options, [$golongan_darah_database]);


        // Rhesus
        $rhesus_database = $anggota->rhesus;
        $rhesus_options = ['+', '-'];

        // Menghapus rhesus dari database dari opsi yang akan ditampilkan
        $rhesus_options = array_diff($rhesus_options, [$rhesus_database]);

        // Bersedia
        $bersedia_database = $anggota->bersedia;
        $bersedia_options = ['Ya', 'Tidak'];

        // Menghapus bersedia dari database dari opsi yang akan ditampilkan
        $bersedia_options = array_diff($bersedia_options, [$bersedia_database]);

        // Status
        $status_database = $anggota->status;
        $status_options = ['Menikah', 'Belum Menikah'];

        // Menghapus status dari database dari opsi yang akan ditampilkan
        $status_options = array_diff($status_options, [$status_database]);

        // Keanggotaan
        $keanggotaan_database = $anggota->keanggotaan;
        $keanggotaan_options = ['BAPTIS', 'SIDI', 'BAPTIS DEWASA', 'Belum'];

        // Menghapus keanggotaan dari database dari opsi yang akan ditampilkan
        $keanggotaan_options = array_diff($keanggotaan_options, [$keanggotaan_database]);

        // Pendidikan
        $pendidikan_database = $anggota->pendidikan;
        $pendidikan_options = ['SD / Sederajat', 'SMP / Sederajat', 'SMA / Sederajat', 'D3 (Diploma)', 'S1 (Sarjana)', 'S2 (Magister)', 'S3 (Doktor)'];

        // Menghapus pendidikan dari database dari opsi yang akan ditampilkan
        $pendidikan_options = array_diff($pendidikan_options, [$pendidikan_database]);

        // Pekerjaan
        $pekerjaan_database = $anggota->pekerjaan;
        $pekerjaan_options = ['Pelajar', 'Mahasiswa', 'PNS', 'Wiraswasta', 'Wirausaha', 'Lainnya'];

        // Menghapus pekerjaan dari database dari opsi yang akan ditampilkan
        $pekerjaan_options = array_diff($pekerjaan_options, [$pekerjaan_database]);

        // Domisili
        $domisili_database = $anggota->domisili;
        $domisili_options = ['Di Dalam Wilayah Pelayanan', 'Di Luar Wilayah Pelayanan'];

        // Menghapus domisili dari database dari opsi yang akan ditampilkan
        $domisili_options = array_diff($domisili_options, [$domisili_database]);

        // Keterangan tinggal
        $keterangan_tinggal_database = $anggota->keterangan_tinggal;
        $keterangan_tinggal_options = ['Bersama Orang Tua', 'Rumah Keluarga', 'Kos-kosan', 'Asrama'];

        // Menghapus keterangan tinggal dari database dari opsi yang akan ditampilkan
        $keterangan_tinggal_options = array_diff($keterangan_tinggal_options, [$keterangan_tinggal_database]);

        // Wilayah
        $wilayah_database = $anggota->wilayah;
        $wilayah_options = ['1', '2'];

        // Menghapus wilayah dari database dari opsi yang akan ditampilkan
        $wilayah_options = array_diff($wilayah_options, [$wilayah_database]);

        $kaderisasi = Kaderisasi::where('anggota_id', $id)->get();

        $pelatihan = Pelatihan::all();

        return view('pages.admin.anggota.edit', [
            'anggota' => $anggota,
            'jenis_kelamin_options' => $jenis_kelamin_options,
            'jenis_kelamin_database' => $jenis_kelamin_database,
            'golongan_darah_database' => $golongan_darah_database,
            'golongan_darah_options' => $golongan_darah_options,
            'rhesus_database' => $rhesus_database,
            'rhesus_options' => $rhesus_options,
            'bersedia_database' => $bersedia_database,
            'bersedia_options' => $bersedia_options,
            'status_database' => $status_database,
            'status_options' => $status_options,
            'keanggotaan_database' => $keanggotaan_database,
            'keanggotaan_options' => $keanggotaan_options,
            'pendidikan_database' => $pendidikan_database,
            'pendidikan_options' => $pendidikan_options,
            'pekerjaan_database' => $pekerjaan_database,
            'pekerjaan_options' => $pekerjaan_options,
            'domisili_database' => $domisili_database,
            'domisili_options' => $domisili_options,
            'keterangan_tinggal_database' => $keterangan_tinggal_database,
            'keterangan_tinggal_options' => $keterangan_tinggal_options,
            'wilayah_database' => $wilayah_database,
            'wilayah_options' => $wilayah_options,
            'kaderisasi' => $kaderisasi,
            'pelatihan' => $pelatihan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $tahun = $data['tahun'];
        // Update data anggota
        $anggota = DataAnggota::findOrFail($id);

        $anggota->update([
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
            foreach ($kaderisasi as $item) {
                $dataPelatihan = [
                    'tahun' => 0,
                    'anggota_id' => $anggota->id,
                    'pelatihan_id' => $item,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $pelatihan[] = $dataPelatihan;
            }
        } else {
            foreach ($kaderisasi as $index => $item) {
                $dataPelatihan = [
                    'tahun' => $tahun[$index + 1], // Menggunakan nilai tahun yang sesuai
                    'anggota_id' => $anggota->id,
                    'pelatihan_id' => $item,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $pelatihan[] = $dataPelatihan;
            }
        }

        //Delete yang lama
        Kaderisasi::where('anggota_id', $id)->delete();
        Kaderisasi::insert($pelatihan);

        return redirect()->route('data-anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DataAnggota::findOrFail($id)->delete();

        return redirect()->route('data-anggota.index');
    }

    public function print()
    {
        $anggota = DataAnggota::all();

        // Ambil data kaderisasi dari masing-masing anggota
        $kaderisasi = [];

        foreach ($anggota as $item) {
            $kaderisasi[] = Kaderisasi::where('anggota_id', $item->id)->get();
        }

        // Ambil nama kaderisasinya 
        foreach ($kaderisasi as $index => $kaderisasiAnggota) {
            foreach ($kaderisasiAnggota as $kader) {
                $kader->pelatihan_id = Pelatihan::where('id', $kader->pelatihan_id)->first()->nama_pelatihan;
            }
        }

        return view('pages.admin.anggota.print', [
            'anggota' => $anggota,
            'kaderisasi' => $kaderisasi,
        ]);
    }
}
