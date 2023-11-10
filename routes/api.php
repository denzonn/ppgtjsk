<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BidangController;
use App\Http\Controllers\Api\DataAnggotaController;
use App\Http\Controllers\Api\DokumentController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\FotoKsbController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\InventarisController;
use App\Http\Controllers\Api\IuranController;
use App\Http\Controllers\Api\JabatanController;
use App\Http\Controllers\Api\JadwalKegiatanController;
use App\Http\Controllers\Api\JenisInventarisController;
use App\Http\Controllers\Api\KegiatanController;
use App\Http\Controllers\Api\KeuanganController;
use App\Http\Controllers\Api\NotulensiRapatController;
use App\Http\Controllers\Api\PemasukanController;
use App\Http\Controllers\Api\PengeluaranController;
use App\Http\Controllers\Api\PengurusController;
use App\Http\Controllers\Api\PiutangController;
use App\Http\Controllers\Api\ProfilController;
use App\Http\Controllers\Api\ProgramKerjaController;
use App\Http\Controllers\Api\RenunganController;
use App\Http\Controllers\Api\SaranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::get('renungan', [RenunganController::class, 'index']);
    Route::get('renungan/{id}', [RenunganController::class, 'edit']);
    Route::put('renungan/{id}', [RenunganController::class, 'update']);

    Route::get('jadwal-kegiatan', [JadwalKegiatanController::class, 'index']);
    Route::get('jadwal-kegiatan/kegiatan', [JadwalKegiatanController::class, 'create']);
    Route::post('jadwal-kegiatan', [JadwalKegiatanController::class, 'store']);
    Route::get('jadwal-kegiatan/{id}', [JadwalKegiatanController::class, 'edit']);
    Route::put('jadwal-kegiatan/{id}', [JadwalKegiatanController::class, 'update']);
    Route::delete('jadwal-kegiatan/destroy/{id}', [JadwalKegiatanController::class, 'destroy']);

    Route::get('faq', [FaqController::class, 'index']);
    Route::post('faq', [FaqController::class, 'store']);
    Route::get('faq/{id}', [FaqController::class, 'edit']);
    Route::put('faq/{id}', [FaqController::class, 'update']);
    Route::delete('faq/destroy/{id}', [FaqController::class, 'destroy']);

    Route::get('foto-ksb', [FotoKsbController::class, 'index']);
    Route::get('foto-ksb/{id}', [FotoKsbController::class, 'edit']);
    Route::put('foto-ksb/{id}', [FotoKsbController::class, 'update']);
    
    Route::get('jabatan', [JabatanController::class, 'index']);
    Route::post('jabatan', [JabatanController::class, 'store']);
    Route::get('jabatan/{id}', [JabatanController::class, 'edit']);
    Route::put('jabatan/{id}', [JabatanController::class, 'update']);
    Route::delete('jabatan/destroy/{id}', [JabatanController::class, 'destroy']);

    Route::get('bidang', [BidangController::class, 'index']);
    Route::post('bidang', [BidangController::class, 'store']);
    Route::get('bidang/{id}', [BidangController::class, 'edit']);
    Route::put('bidang/{id}', [BidangController::class, 'update']);
    Route::delete('bidang/destroy/{id}', [BidangController::class, 'destroy']);

    Route::get('pengurus', [PengurusController::class, 'index']);
    Route::post('pengurus', [PengurusController::class, 'store']);
    Route::get('pengurus/{id}', [PengurusController::class, 'edit']);
    Route::get('pengurus/jabatan/{id}', [PengurusController::class, 'getJabatan']);
    Route::get('pengurus/bidang/{id}', [PengurusController::class, 'getBidang']);
    Route::put('pengurus/{id}', [PengurusController::class, 'update']);
    Route::delete('pengurus/destroy/{id}', [PengurusController::class, 'destroy']);

    Route::get('program-kerja', [ProgramKerjaController::class, 'index']);
    Route::get('program-kerja/bidang', [ProgramKerjaController::class, 'getBidang']);
    Route::get('program-kerja/bidang-except/{id}', [ProgramKerjaController::class, 'getBidangExcept']);
    Route::post('program-kerja', [ProgramKerjaController::class, 'store']);
    Route::get('program-kerja/{id}', [ProgramKerjaController::class, 'edit']);
    Route::put('program-kerja/{id}', [ProgramKerjaController::class, 'update']);
    Route::delete('program-kerja/destroy/{id}', [ProgramKerjaController::class, 'destroy']);

    Route::get('notulensi-rapat', [NotulensiRapatController::class, 'index']);
    Route::post('notulensi-rapat', [NotulensiRapatController::class, 'store']);
    Route::get('notulensi-rapat/{id}', [NotulensiRapatController::class, 'edit']);
    Route::put('notulensi-rapat/{id}', [NotulensiRapatController::class, 'update']);
    Route::delete('notulensi-rapat/destroy/{id}', [NotulensiRapatController::class, 'destroy']);

    Route::get('profil', [ProfilController::class, 'index']);
    Route::get('profil/{id}', [ProfilController::class, 'edit']);
    Route::put('profil/{id}', [ProfilController::class, 'update']);

    Route::get('dokument', [DokumentController::class, 'index']);
    Route::post('dokument', [DokumentController::class, 'store']);
    Route::get('dokument/{id}', [DokumentController::class, 'edit']);
    Route::put('dokument/{id}', [DokumentController::class, 'update']);
    Route::delete('dokument/destroy/{id}', [DokumentController::class, 'destroy']);

    Route::get('data-anggota', [DataAnggotaController::class, 'index']);
    Route::post('data-anggota', [DataAnggotaController::class, 'store']);
    Route::get('data-anggota/{id}', [DataAnggotaController::class, 'edit']);
    Route::put('data-anggota/{id}', [DataAnggotaController::class, 'update']);
    Route::delete('data-anggota/destroy/{id}', [DataAnggotaController::class, 'destroy']);

    Route::get('kegiatan', [KegiatanController::class, 'index']);
    Route::post('kegiatan', [KegiatanController::class, 'store']);
    Route::get('kegiatan/program', [KegiatanController::class, 'programKerja']);
    Route::get('kegiatan/{id}', [KegiatanController::class, 'edit']);
    Route::put('kegiatan/{id}', [KegiatanController::class, 'update']);
    Route::delete('kegiatan/destroy/{id}', [KegiatanController::class, 'destroy']);

    Route::get('gallery', [GalleryController::class, 'index']);
    Route::get('gallery/kegiatan', [GalleryController::class, 'create']);
    Route::post('gallery', [GalleryController::class, 'store']);
    Route::delete('gallery/destroy/{id}', [GalleryController::class, 'destroy']);

    Route::get('jenis-inventaris', [JenisInventarisController::class, 'index']);
    Route::post('jenis-inventaris', [JenisInventarisController::class, 'store']);
    Route::get('jenis-inventaris/{id}', [JenisInventarisController::class, 'edit']);
    Route::put('jenis-inventaris/{id}', [JenisInventarisController::class, 'update']);
    Route::delete('jenis-inventaris/destroy/{id}', [JenisInventarisController::class, 'destroy']);

    Route::get('inventaris', [InventarisController::class, 'index']);
    Route::get('inventaris/jenis', [InventarisController::class, 'create']);
    Route::post('inventaris', [InventarisController::class, 'store']);
    Route::get('inventaris/{id}', [InventarisController::class, 'edit']);
    Route::put('inventaris/{id}', [InventarisController::class, 'update']);
    Route::delete('inventaris/destroy/{id}', [InventarisController::class, 'destroy']);

    Route::get('pemasukan', [PemasukanController::class, 'index']);
    Route::post('pemasukan', [PemasukanController::class, 'store']);
    Route::get('pemasukan/{id}', [PemasukanController::class, 'edit']);
    Route::put('pemasukan/{id}', [PemasukanController::class, 'update']);
    Route::delete('pemasukan/destroy/{id}', [PemasukanController::class, 'destroy']);

    Route::get('pengeluaran', [PengeluaranController::class, 'index']);
    Route::post('pengeluaran', [PengeluaranController::class, 'store']);
    Route::get('pengeluaran/{id}', [PengeluaranController::class, 'edit']);
    Route::put('pengeluaran/{id}', [PengeluaranController::class, 'update']);
    Route::delete('pengeluaran/destroy/{id}', [PengeluaranController::class, 'destroy']);

    Route::get('piutang', [PiutangController::class, 'index']);
    Route::post('piutang', [PiutangController::class, 'store']);
    Route::get('piutang/{id}', [PiutangController::class, 'edit']);
    Route::put('piutang/{id}', [PiutangController::class, 'update']);
    Route::delete('piutang/destroy/{id}', [PiutangController::class, 'destroy']);

    Route::get('keuangan', [KeuanganController::class, 'index']);

    Route::get('iuran', [IuranController::class, 'index']);
    Route::post('iuran', [IuranController::class, 'store']);
    Route::get('iuran/{id}', [IuranController::class, 'edit']);
    Route::put('iuran/{id}', [IuranController::class, 'update']);
    Route::delete('iuran/destroy/{id}', [IuranController::class, 'destroy']);

    Route::get('saran', [SaranController::class, 'index']);
});