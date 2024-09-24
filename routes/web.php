<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanDinasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerjalananDinasController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\SppdController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\VerifikasiTugasController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Dashboard',
    ]);
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/rapat', [RapatController::class, 'index'])->name('rapat.index');
Route::post('/rapat/store', [RapatController::class, 'store'])->name('rapat.store');
Route::get('/rapat/create', [RapatController::class, 'create'])->name('rapat.create');
Route::get('/rapat/{rapat}/', [RapatController::class, 'show'])->name('rapat.show');
Route::patch('/rapat/{rapat}/presensi/peserta/{peserta}', [RapatController::class, 'updatePresensiPeserta'])->middleware('auth');
Route::patch('/rapat/update/{rapat}', [RapatController::class, 'update'])->name('rapat.update');
Route::delete('/rapat/destroy/{rapat}', [RapatController::class, 'destroy'])->name('rapat.destroy');
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

Route::get('/tugas/verifikasi', [VerifikasiTugasController::class, 'index'])->name('tugas.verifikasi.index');
Route::get('/tugas/verifikasi/{tugas}', [VerifikasiTugasController::class, 'show'])->name('tugas.verifikasi.show');
Route::post('/tugas/verifikasi/{tugas}/terima', [VerifikasiTugasController::class, 'terima'])->name('tugas.verifikasi.terima');
Route::post('/tugas/verifikasi/{tugas}/tolak', [VerifikasiTugasController::class, 'tolak'])->name('tugas.verifikasi.tolak');

Route::get('/perjalanan-dinas', [PerjalananDinasController::class, 'index'])->name('perjalanan-dinas.index');

Route::get('/perjalanan-dinas/sppd', [SppdController::class, 'index'])->name('sppd.index');
Route::get('/perjalanan-dinas/sppd/create', [SppdController::class, 'create'])->name('sppd.create');
Route::post('/perjalanan-dinas/sppd/store', [SppdController::class, 'store'])->name('sppd.store');
Route::get('/perjalanan-dinas/sppd/show/{sppd}', [SppdController::class, 'show'])->name('sppd.show');
Route::get('/perjalanan-dinas/sppd/edit/{sppd}', [SppdController::class, 'edit'])->name('sppd.edit');
Route::patch('/perjalanan-dinas/sppd/update/{sppd}', [SppdController::class, 'update'])->name('sppd.update');
Route::delete('/perjalanan-dinas/sppd/destroy/{sppd}', [SppdController::class, 'destroy'])->name('sppd.destroy');

Route::get('/perjalanan-dinas/laporan', [LaporanDinasController::class, 'index'])->name('laporan-dinas.index');
Route::get('/perjalanan-dinas/laporan/create', [LaporanDinasController::class, 'create'])->name('laporan-dinas.create');
Route::post('/perjalanan-dinas/laporan/store', [LaporanDinasController::class, 'store'])->name('laporan-dinas.store');
Route::get('/perjalanan-dinas/laporan/show/{laporan}', [LaporanDinasController::class, 'show'])->name('laporan-dinas.show');
Route::get('/perjalanan-dinas/laporan/edit/{laporan}', [LaporanDinasController::class, 'edit'])->name('laporan-dinas.edit');
Route::patch('/perjalanan-dinas/laporan/update/{laporan}', [LaporanDinasController::class, 'update'])->name('laporan-dinas.update');
Route::delete('/perjalanan-dinas/laporan/destroy/{laporan}', [LaporanDinasController::class, 'destroy'])->name('laporan-dinas.destroy');

Route::get('/perjalanan-dinas/laporan/verifikasi', [VerifikasiLaporanDinasController::class, 'index'])->name('laporan-dinas.verifikasi.index');
Route::get('/perjalanan-dinas/laporan/verifikasi/{laporan}', [VerifikasiLaporanDinasController::class, 'show'])->name('laporan-dinas.verifikasi.show');
Route::post('/perjalanan-dinas/laporan/verifikasi/{laporan}/terima', [VerifikasiLaporanDinasController::class, 'terima'])->name('laporan-dinas.verifikasi.terima');
Route::post('/perjalanan-dinas/laporan/verifikasi/{laporan}/tolak', [VerifikasiLaporanDinasController::class, 'tolak'])->name('laporan-dinas.verifikasi.tolak');