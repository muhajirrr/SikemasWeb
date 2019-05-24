<?php

namespace App\Http\Controllers\Api\Kehadiran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kehadiran;
use App\Kelas;
use App\Http\Resources\KehadiranResource;
use App\Http\Resources\KelasActiveResource;

class KehadiranController extends Controller
{
    public function index(Request $request) {
        try {
            $user = $request->user();
            $kelas = Kelas::findOrFail(request('kelas_id'));
            $kelas_active = $kelas->kelas_active;

            foreach ($kelas_active as $kelas) {
                $kehadiran = Kehadiran::where('user_id', $user->id)->where('kelas_active_id', $kelas->id)->first();
                if ($kehadiran) {
                    $kelas->status_absen = 1;
                } else {
                    $kelas->status_absen = 0;
                }
            }

            $kelas_active_resource = KelasActiveResource::collection($kelas_active);

            return response()->json([
                'status' => 'success',
                'data' => $kelas_active_resource
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request) {
        try {
            $kehadiran = Kehadiran::create([
                'user_id' => $request->user()->id,
                'kelas_active_id' => $request->kelas_active_id,
                'status' => 1
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $kehadiran
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
