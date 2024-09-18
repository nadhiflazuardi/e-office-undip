<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title' => 'Dashboard',
    ]);
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::patch('/rapat/{rapat}/presensi/peserta/{peserta}', [RapatController::class, 'updatePresensiPeserta'])->middleware('auth');

Route::get('/rapat', [RapatController::class, 'index'])->name('rapat.index');
Route::post('/rapat/store', [RapatController::class, 'store'])->name('rapat.store');
Route::patch('/rapat/update/{id}', [RapatController::class, 'update'])->name('rapat.update');
Route::delete('/rapat/destroy/{id}', [RapatController::class, 'destroy'])->name('rapat.destroy');

Route::get('/surat-masuk', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
Route::post('/surat-masuk/store', [SuratMasukController::class, 'store'])->name('surat-masuk.store');
Route::get('/surat-masuk/show/{surat}', [SuratMasukController::class, 'show'])->name('surat-masuk.show');
Route::get('/surat-masuk/edit/{surat}', [SuratMasukController::class, 'edit'])->name('surat-masuk.edit');
Route::patch('/surat-masuk/update/{surat}', [SuratMasukController::class, 'update'])->name('surat-masuk.update');
Route::delete('/surat-masuk/destroy/{surat}', [SuratMasukController::class, 'destroy'])->name('surat-masuk.destroy');

Route::get('/surat-keluar', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
Route::post('/surat-keluar/store', [SuratKeluarController::class, 'store'])->name('surat-keluar.store');
Route::get('/surat-keluar/show/{surat}', [SuratKeluarController::class, 'show'])->name('surat-keluar.show');
Route::get('/surat-keluar/edit/{surat}', [SuratKeluarController::class, 'edit'])->name('surat-keluar.edit');
Route::patch('/surat-keluar/update/{surat}', [SuratKeluarController::class, 'update'])->name('surat-keluar.update');
Route::delete('/surat-keluar/destroy/{surat}', [SuratKeluarController::class, 'destroy'])->name('surat-keluar.destroy');