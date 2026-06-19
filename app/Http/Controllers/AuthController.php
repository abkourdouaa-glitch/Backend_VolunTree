<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $fields=$request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Identifiants incorrects'], 401);
        }

        if (!$user->is_admin) {
        return response([
            'message' => 'Accès refusé : vous n\'êtes pas administrateur'
        ], 403);
    }

        $token = $user->createToken('mon_token_secret')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);

    }
    
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return ['message' => 'Déconnecté'];
    }
}
