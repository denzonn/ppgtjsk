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
use App\Http\Controllers\Admin\InventarisController;
use App\Http\Controllers\Admin\JenisInventarisController;
use App\Http\Controllers\Admin\NotulensiRapat;
use App\Http\Controllers\Admin\NotulensiRapatController;
use App\Http\Controllers\Admin\SaranController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GalleryActivityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SaranController as SaranCon;
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
Route::get('/keanggotaan', [MemberController::class, 'index'])
    ->name('member');
Route::get('/profil-ppgt', [ProfilController::class, 'index'])
    ->name('profil');
Route::post('/', [SaranCon::class, 'store'])
    ->name('user.saran');

Route::prefix('admin')
    // ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
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
        Route::get('data-anggota-print', [DataAnggotaController::class, 'print'])
            ->name('data-anggota.print');
        Route::get('inventaris-print', [InventarisController::class, 'print'])
            ->name('inventaris.print');
    });

Auth::routes();
