<?php

namespace App\Http\Controllers\Api\KelasActive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\KelasActive;
use App\Http\Resources\KelasActiveResource;
use Carbon\Carbon;
use App\Kehadiran;

class KelasActiveController extends Controller
{
    public function index(Request $request) {
        try {
            $user = $request->user();
        
            $kelas_ids = $user->kelas->pluck('id')->toArray();
            $kelas_active = KelasActive::whereIn('kelas_id', $kelas_ids)->where('status', 1)->whereDate('created_at', Carbon::now())->get();

            foreach ($kelas_active as $k) {
                $kehadiran = Kehadiran::where('user_id', $user->id)->where('kelas_active_id', $k->id)->where('status', 1)->first();
                if ($kehadiran) {
                    $k->status_absen = 1;
                } else {
                    $k->status_absen = 0;
                }
            }

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
