<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use App\Models\Benevole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 

class BenevoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('benevoles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|unique:benevoles',
            'password' => 'required|min:8',
            'ville' => 'required',
            'date_naissance' => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'),
        ],[
            'date_naissance.before' => 'Vous devez avoir au moins 18 ans pour créer un compte.'
        ]);


        $benevole = \App\Models\Benevole::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ville' => $request->ville,
            'date_naissance' => $request->date_naissance,
            'photo_profile' => null,
            'role' => 'benevole', 
        ]);

        $Auth = Auth::login($benevole);
        $token = $benevole->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Bénévole créé avec succès !',
            'access_token' => $token,
            'user' => $benevole,
            'role' => 'benevole'
        ], 201);
    }

    public function getData()
    {
        $benevole = Auth::user();
        if (!$benevole) {
            return response()->json(['message' => 'Non authentifié'], 401);
        }
        return response()->json([
            'status' => 'success',
            'data' => [
                'nom' => $benevole->nom,
                'email' => $benevole->email,
                'ville' => $benevole->ville,
                'date_naissance' => $benevole->date_naissance,
                'role' => $benevole->role,
                'photo_profile_url' => $benevole->photo_profile ? asset('storage/' . $benevole->photo_profile) : null,
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Benevole $benevole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Benevole $benevole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $benevole = Auth::user();

        $request->validate([
            'nom'            => 'sometimes|string|max:255',
            'ville'          => 'sometimes|string',
            'date_naissance' => 'sometimes|date',
            'photo_profile'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->filled('nom'))            $benevole->nom = $request->nom;
        if ($request->filled('ville'))          $benevole->ville = $request->ville;
        if ($request->filled('date_naissance')) $benevole->date_naissance = $request->date_naissance;

        // Password
        if ($request->filled('password')) {
            $benevole->password = Hash::make($request->password);
        }

        // Photo
        if ($request->hasFile('photo_profile')) {
            if ($benevole->photo_profile) {
                Storage::disk('public')->delete($benevole->photo_profile);
            }
            $path = $request->file('photo_profile')->store('profiles', 'public');
            $benevole->photo_profile = $path;
        }

        $benevole->save();

        return response()->json([
            'status' => 'success',
            'data'   => $benevole,
            'photo_profile_url' => $benevole->photo_profile
                ? asset('storage/' . $benevole->photo_profile)
                : null,
        ]);
    }

    public function getProfile(Request $request)
    {
        $benevole = $request->user();
        return response()->json([
            'nom'              => $benevole->nom,
            'email'            => $benevole->email,
            'ville'            => $benevole->ville,
            'date_naissance'   => $benevole->date_naissance,
            'photo_profile_url'=> $benevole->photo_profile
                ? asset('storage/' . $benevole->photo_profile)
                : null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benevole $benevole)
    {
        //
    }
}