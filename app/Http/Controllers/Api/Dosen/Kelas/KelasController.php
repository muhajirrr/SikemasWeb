<?php

namespace App\Http\Controllers\Api\Dosen\Kelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KelasResource;

class KelasController extends Controller
{
    public function index(Request $request) {
        try {
            $hari = strtolower(request('hari'));
            $user = $request->user();
        
            $kelas = $user->kelas_dosen()->whereHari($hari)->get();

            $kelas_resource = KelasResource::collection($kelas);
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
