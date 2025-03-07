<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('api')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out',
        ], 200);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
