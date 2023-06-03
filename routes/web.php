<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RenunganHarianController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GalleryActivityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfilController;
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

Route::prefix('admin')
    // ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('renungan-harian', RenunganHarianController::class);
    });

Auth::routes();
