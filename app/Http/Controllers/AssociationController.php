<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class AssociationController extends Controller
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
        // return view('associations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   {
        $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email|unique:associations',
            'password' => 'required|min:8',
            'telephone' => 'required|string',
            'ville' => 'required',
            'description' => 'required',
            // 'recepisse' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // $filePath = null;
        // if ($request->hasFile('recepisse')) {
        //     $filePath = $request->file('recepisse')->store('recepisses', 'public');
        // }

        $association = \App\Models\Association::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'telephone' => $request->telephone,
            'ville' => $request->ville,
            'description' => $request->description,
            // 'recepisse' => $filePath, 
            'photo_profile' => null, 
            'role' => 'association',
        ]);
        Auth::login($association);
        $token = $association->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Association créée avec succès !',
            'user' => $association,
            'access_token' => $token,              
            'role' => 'association'
        ], 201);
    }

    public function getData()
    {
        $association = Auth::user();
        if (!$association) {
            return response()->json(['message' => 'Non authentifié'], 401);
        }
        return response()->json([
            'status' => 'success',
            'data' => [
                'nom' => $association->nom,
                'email' => $association->email,
                'ville' => $association->ville,
                'telephone' => $association->telephone,
                'description' => $association->description,
                // 'recepisse' => $association->recepisse,
                'role' => $association->role,
                'photo_profile_url' => $association->photo_profile ? asset('storage/' . $association->photo_profile) : null,
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Association $association)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Association $association)
    {
        //
    }

   
    public function update(Request $request)
    {
        $association = Auth::user();

        $request->validate([
            'nom'           => 'sometimes|string|max:255',
            'telephone'     => 'sometimes|nullable|string', 
            'ville'         => 'sometimes|string',
            'description'   => 'sometimes|string',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->filled('nom'))         $association->nom = $request->nom;
        if ($request->filled('telephone'))   $association->telephone = (string) $request->telephone;
        if ($request->filled('ville'))       $association->ville = $request->ville;
        if ($request->filled('description')) $association->description = $request->description;

        if ($request->hasFile('photo_profile')) {
            if ($association->photo_profile) {
                Storage::disk('public')->delete($association->photo_profile);
            }
            $path = $request->file('photo_profile')->store('profiles', 'public');
            $association->photo_profile = $path;
        }

        $association->save();

        return response()->json([
            'status' => 'success',
            'data'   => $association,
            'photo_profile_url' => $association->photo_profile
                ? asset('storage/' . $association->photo_profile)
                : null,
        ]);
    }

    public function getProfile(Request $request)
    {
        $association = $request->user();
        return response()->json([
            'nom'               => $association->nom,
            'email'             => $association->email,
            'ville'             => $association->ville,
            'telephone'         => $association->telephone,
            'description'       => $association->description,
            'photo_profile_url' => $association->photo_profile
                ? asset('storage/' . $association->photo_profile)
                : null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Association $association)
    {
        //
    }
}
