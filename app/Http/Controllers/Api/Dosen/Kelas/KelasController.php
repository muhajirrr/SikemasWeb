<?php

namespace App\Http\Controllers\Api\Dosen\Kelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Resources\KelasDosenResource;

class KelasController extends Controller
{
    public function index(Request $request) {
        try {
            $hari = strtolower(request('hari'));
            $user = $request->user();
        
            $kelas = $user->kelas_dosen()->whereHari($hari)->get();
            
            foreach ($kelas as $k) {
                $kelas_active = $k->kelas_active()->whereDate('created_at', Carbon::now())->first();
                if ($kelas_active) {
                    if ($kelas_active->status == 1) $k->status = 1;
                    else $k->status = 2;
                } else {
                    $k->status = 0;
                }
            }

            $kelas_resource = KelasDosenResource::collection($kelas);
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
