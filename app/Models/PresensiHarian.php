<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiHarian extends Model
{
    use HasFactory;

    protected $table = 'presensi_harian';

    protected $guarded = ['id'];
}
