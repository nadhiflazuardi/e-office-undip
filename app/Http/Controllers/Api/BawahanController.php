<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BawahanController extends Controller
{
  public function getById($id)
  {
    $bawahans = User::where('supervisor_id', $id)->get();

    return response()->json([
      'message' => 'Berhasil menampilkan data',
      'data' => $bawahans
    ]);
  }
}
