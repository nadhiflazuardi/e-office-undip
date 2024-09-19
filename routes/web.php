<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Dashboard',
    ]);
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


Route::get('/rapat', [RapatController::class, 'index'])->name('rapat.index');
Route::post('/rapat/store', [RapatController::class, 'store'])->name('rapat.store');
Route::get('/rapat/{rapat}', [RapatController::class, 'show'])->name('rapat.show');
Route::patch('/rapat/{rapat}/presensi/peserta/{peserta}', [RapatController::class, 'updatePresensiPeserta'])->middleware('auth');
Route::patch('/rapat/{rapat}/update', [RapatController::class, 'update'])->name('rapat.update');
Route::delete('/rapat/{rapat}/destroy', [RapatController::class, 'destroy'])->name('rapat.destroy');

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

Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
Route::post('/tugas/store', [TugasController::class, 'store'])->name('tugas.store');
Route::get('/tugas/show/{tugas}', [TugasController::class, 'show'])->name('tugas.show');
Route::get('/tugas/edit/{tugas}', [TugasController::class, 'edit'])->name('tugas.edit');
Route::patch('/tugas/update/{tugas}', [TugasController::class, 'update'])->name('tugas.update');
Route::delete('/tugas/destroy/{tugas}', [TugasController::class, 'destroy'])->name('tugas.destroy');
