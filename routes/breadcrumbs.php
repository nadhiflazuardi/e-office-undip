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