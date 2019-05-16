<?php

namespace App\Http\Controllers\Api\Kelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\User;
use App\Http\Resources\KelasResource;

class KelasController extends Controller
{
    public function index(Request $request) {
        try {
            $hari = request('hari');
            $user = $request->user();
        
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
