<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Association;
use App\Models\Benevole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Association::where('email', $request->email)->first();
        $role = 'association';

        if (!$user) {
            $user = Benevole::where('email', $request->email)->first();
            $role = 'benevole';
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email ou mot de passe incorrect.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'user' => $user, 
            'role' => $role
        ]);
    }

    public function logout(Request $request)
    {
        // Supprimer le token actuel
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie.'
        ]);
    }
}
