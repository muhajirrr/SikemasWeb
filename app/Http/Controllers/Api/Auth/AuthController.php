<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        try {
            $request->validate([
                'no_identitas' => 'required|string',
                'password' => 'required|string',
            ]);

            $credentials = request(['no_identitas', 'password']);

            if(!Auth::attempt($credentials))
                return response()->json([
                    'status' => 'error',
                    'message' => 'The user credentials were incorrect.'
                ]);

            $user = $request->user();

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'token_type' => 'Bearer',
                    'access_token' => $tokenResult->accessToken,
                    'user' => $user
                ]
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request) {
        try {
            $request->user()->token()->revoke();

            return response()->json([
                'status' => 'success',
                'data' => 'Successfully logged out.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
