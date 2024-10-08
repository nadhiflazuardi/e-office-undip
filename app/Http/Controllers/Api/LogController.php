<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LogResource;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function getById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan',
                'data' => null
            ], 404);
        }

        $groupedLogs = Log::select(
            DB::raw('SUBSTRING(kegiatan_id, 1, 1) as kode_kegiatan'),
            DB::raw('SUM(bobot) as total_bobot')
        )
            ->where('pegawai_id', $id)
            ->groupBy(DB::raw('kode_kegiatan'))
            ->get();

        if ($groupedLogs->isEmpty()) {
            return response()->json([
                'message' => 'Data log tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Berhasil menampilkan data',
            'data' => $groupedLogs
        ]);
    }
}
