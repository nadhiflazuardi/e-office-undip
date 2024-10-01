<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\PerjalananDinas;
use App\Models\Rapat;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Rapat Index
Breadcrumbs::for('rapat.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Rapat', route('rapat.index'));
});

// Rapat Create
Breadcrumbs::for('rapat.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Buat Rapat', route('rapat.create'));
});

// Rapat Show
Breadcrumbs::for('rapat.show', function (BreadcrumbTrail $trail, Rapat $rapat) {
    $trail->parent('rapat.index');
    $trail->push($rapat->judul, route('rapat.show', $rapat));
});

// SPPD Index
Breadcrumbs::for('sppd.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('SPPD', route('sppd.index'));
});

// SPPD Create
Breadcrumbs::for('sppd.create', function (BreadcrumbTrail $trail) {
    $trail->parent('sppd.index');
    $trail->push('Buat SPPD', route('sppd.create'));
});

// sppd show
Breadcrumbs::for('sppd.show', function (BreadcrumbTrail $trail, PerjalananDinas $sppd) {
    $trail->parent('sppd.index');
    $trail->push($sppd->nomor_surat, route('sppd.show', $sppd));
});

// Verifikasi SPPD Index
Breadcrumbs::for('laporan-dinas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Verifikasi SPPD', route('laporan-dinas.index'));
});

// Verifikasi SPPD Show
Breadcrumbs::for('laporan-dinas.show', function (BreadcrumbTrail $trail, PerjalananDinas $perjalananDinas) {
    $trail->parent('laporan-dinas.index');
    $trail->push($perjalananDinas->nomor_surat, route('laporan-dinas.show',['perjalananDinas' => $perjalananDinas]));
});

// Surat Masuk Index
Breadcrumbs::for('surat-masuk.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Surat Masuk', route('surat-masuk.index'));
});

// Surat Masuk Create
Breadcrumbs::for('surat-masuk.create', function (BreadcrumbTrail $trail) {
    $trail->parent('surat-masuk.index');
    $trail->push('Buat Surat Masuk', route('surat-masuk.create'));
});

// Surat Keluar Index
Breadcrumbs::for('surat-keluar.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Surat Keluar', route('surat-keluar.index'));
});

// Surat Keluar Create
Breadcrumbs::for('surat-keluar.create', function (BreadcrumbTrail $trail) {
    $trail->parent('surat-keluar.index');
    $trail->push('Buat Surat Keluar', route('surat-keluar.create'));
});