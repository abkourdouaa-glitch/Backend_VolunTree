<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Entreprise;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Stage::all();
        return view('stages.index', compact('stages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $entreprises = Entreprises::all(); 
        return view('stages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre'=>'required|string',
            'duree_mois'=>'required',
            'date_debut'=>'required',
            'entreprise_id'=>'required'
        ]);

        $stage = new Stage([
            'titre'=>$request->titre,
            'duree_mois'=>$request->duree_mois,
            'date_debut'=>$request->date_debut,
            'entreprise_id'=>$request->entreprise_id,
        ]);
        $stage->save();
        return redirect()->route('stages.index')->with('success','ajout succée!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stage = Stage::findOrFail($id);
        return view('stages.show', compact('stage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entreprises = Entreprise::all();
        $stage = Stage::findOrFail($id);
        return view('stage.edit', compact('stage','entreprises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'titre'=>'required|string',
            'duree_mois'=>'required',
            'date_debut'=>'required',
            'entreprise_id'=>'required'
        ]);

        $stage = Stage::findOrFail($id);
        $stage->update([
            'titre'=>$request->titre,
            'duree_mois'=>$request->duree_mois,
            'date_debut'=>$request->date_debut,
            'entreprise_id'=>$request->entreprise_id
        ]);
        return redirect()->route('stages.index')->with('success', 'modifier avec succée!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();
        return redirect()->route('stages.index')->with('success','supprimer avec succée!');
    }
}
