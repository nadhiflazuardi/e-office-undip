<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $guarded = ['id'];


    public function tanggalDiterima()
    {
        return Carbon::parse($this->created_at)->translatedFormat('l, j F Y');
    }
}
