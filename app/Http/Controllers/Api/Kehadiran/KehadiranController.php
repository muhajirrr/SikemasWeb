<?php

namespace App\Http\Controllers\Api\Kehadiran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kehadiran;

class KehadiranController extends Controller
{
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
