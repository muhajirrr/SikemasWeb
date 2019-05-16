<?php

namespace App\Http\Controllers\Api\KelasActive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\KelasActive;
use App\Http\Resources\KelasActiveResource;

class KelasActiveController extends Controller
{
    public function index(Request $request) {
        try {
            $user = $request->user();
        
            $kelas_ids = $user->kelas->pluck('id')->toArray();
            $kelas_active = KelasActive::whereIn('kelas_id', $kelas_ids)->get();

            $kelas_resource = KelasActiveResource::collection($kelas_active);
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
