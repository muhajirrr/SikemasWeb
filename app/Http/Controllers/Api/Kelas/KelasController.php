<?php

namespace App\Http\Controllers\Api\Kelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\User;
use App\Http\Resources\KelasResource;

class KelasController extends Controller
{
    public function index() {
        
        try {
            $hari = request('hari');
            $user = User::where('no_identitas', '05111640000104')->firstOrFail();
        
            $kelas = $user->kelas()->whereHari($hari)->get();

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
