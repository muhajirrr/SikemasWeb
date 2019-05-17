<?php

namespace App\Http\Controllers\Api\Dosen\KelasActive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KelasActive;
use App\Kelas;
use App\Http\Resources\KelasActiveResource;
use Carbon\Carbon;

class KelasActiveController extends Controller
{
    public function store(Request $request) {
        try {
            $kelas = Kelas::findOrFail($request->kelas_id);
            $kelas_active = KelasActive::create([
                'kelas_id' => $kelas->id,
                'jadwal_id' => $kelas->jadwal_id,
                'ruangan_id' => $kelas->ruangan_id,
                'status' => 1,
                'pertemuan' => 1
            ]);

            $kelas_resource = new KelasActiveResource($kelas_active);
            return response()->json([
                'status' => 'success',
                'data' => $kelas_resource
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request) {
        try {
            $kelas = Kelas::findOrFail($request->kelas_id);
            $kelas_active = $kelas->kelas_active()->whereDate('created_at', Carbon::now())->first();

            if ($kelas_active) {
                $kelas_active->update([
                    'status' => 0
                ]);
            }

            $kelas_resource = new KelasActiveResource($kelas_active);
            return response()->json([
                'status' => 'success',
                'data' => $kelas_resource
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
