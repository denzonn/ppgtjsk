<?php

use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataAnggotaController;
use App\Http\Controllers\Admin\FotoKsbController;
use App\Http\Controllers\Admin\GalleryKegiatanController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\ProgramKerjaController;
use App\Http\Controllers\Admin\RenunganHarianController;
use App\Http\Controllers\Admin\DokumentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\InventarisController;
use App\Http\Controllers\Admin\IuranController;
use App\Http\Controllers\Admin\JenisInventarisController;
use App\Http\Controllers\Admin\KegiatanMingguanController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\NotulensiRapat;
use App\Http\Controllers\Admin\NotulensiRapatController;
use App\Http\Controllers\Admin\PemasukkanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\PiutangController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\SaranController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GalleryActivityController;
use App\Http\Controllers\KegiatanController as ControllersKegiatanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SaranController as SaranCon;
use App\Http\Controllers\UnitUsahaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BerandaController::class, 'index'])
    ->name('home');
Route::get('/gallery', [GalleryActivityController::class, 'index'])
    ->name('gallery');
Route::get('/dokument', [DocumentController::class, 'index'])
    ->name('document');
Route::get('/dokument/search', [DocumentController::class, 'search'])
    ->name('document.search');
Route::get('/keanggotaan', [MemberController::class, 'index'])
    ->name('keanggotaan');
Route::get('/profil-ppgt', [ProfilController::class, 'index'])
    ->name('profil');
Route::get('/kegiatan', [ControllersKegiatanController::class, 'index'])
    ->name('kegiatan');
Route::get('/unit-usaha', [UnitUsahaController::class, 'index'])
    ->name('unit-usaha');
Route::get('/kegiatan/detail/{slug}', [ControllersKegiatanController::class, 'detail'])
    ->name('kegiatan-detail');
Route::post('/', [SaranCon::class, 'store'])
    ->name('user.saran');

Route::prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('renungan-harian', RenunganHarianController::class);
        Route::resource('foto-ksb', FotoKsbController::class);
        Route::resource('pengurus', PengurusController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('bidang', BidangController::class);
        Route::resource('data-anggota', DataAnggotaController::class);
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('program-kerja', ProgramKerjaController::class);
        Route::resource('gallery-kegiatan', GalleryKegiatanController::class);
        Route::resource('document', DokumentController::class);
        Route::resource('notulensi-rapat', NotulensiRapatController::class);
        Route::resource('jenis-inventaris', JenisInventarisController::class);
        Route::resource('inventaris', InventarisController::class);
        Route::resource('saran', SaranController::class);
        Route::resource('faq', FaqController::class);
        Route::resource('keuangan/pemasukan', PemasukkanController::class);
        Route::resource('keuangan/pengeluaran', PengeluaranController::class);
        Route::resource('keuangan/piutang', PiutangController::class);
        Route::resource('kegiatan-mingguan', KegiatanMingguanController::class);
        Route::resource('iuran', IuranController::class);
        Route::resource('profil-ppgt', AdminProfilController::class);
        Route::get('keuangan', [KeuanganController::class, 'index'])
            ->name('keuangan');
        Route::get('data-anggota-print', [DataAnggotaController::class, 'print'])
            ->name('data-anggota.print');
        Route::get('inventaris-print', [InventarisController::class, 'print'])
            ->name('inventaris.print');
        Route::post('upload', [AdminProfilController::class, 'uploadImage'])->name('ckeditor.upload');
    });

Auth::routes();
