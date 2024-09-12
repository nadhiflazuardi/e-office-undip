<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuaranTugas extends Model
{
    use HasFactory;

    protected $table = 'luaran_tugas';

    protected $guarded = ['id'];
}
