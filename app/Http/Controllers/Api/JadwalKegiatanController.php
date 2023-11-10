<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\KegiatanMingguan;
use Illuminate\Http\Request;

class JadwalKegiatanController extends BaseController
{
    public function index()
    {
        $kegiatan = KegiatanMingguan::all();

        return $this->sendResponse($kegiatan, 'Successfully get all kegiatan mingguan');
    }

    public function create()
    {
        $kegiatan = Kegiatan::all();

        return $this->sendResponse($kegiatan, 'Successfully get all kegiatan');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        KegiatanMingguan::create($data);

        return $this->sendResponse($data, 'Successfully create kegiatan mingguan');
    }

    public function edit($id)
    {
        $kegiatanMingguan = KegiatanMingguan::findOrFail($id);

        $kegiatan = Kegiatan::all()->except($kegiatanMingguan->kegiatan_id);

        return $this->sendResponse($kegiatan, 'Successfully get kegiatan mingguan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        KegiatanMingguan::findOrFail($id)->update($data);

        return $this->sendResponse($data, 'Successfully update kegiatan mingguan');
    }

    public function destroy($id)
    {
        $kegiatan = KegiatanMingguan::findOrFail($id);
        $kegiatan->delete();

        return $this->sendResponse($kegiatan, 'Successfully delete kegiatan mingguan');
    }
}
