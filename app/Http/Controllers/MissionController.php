<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;  

class MissionController extends Controller
{
    /**
     * Get all missions
     */
    public function index()
    {
        $missions = Mission::with('association')->withCount(['candidatures as vols' => function($query){
            $query->where('statut', 'accepter');
        }])->get();

        return response()->json($missions);
    }

    /**
     * Store a newly created mission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre'          => 'required|string|max:255',
            'description'    => 'required|string',
            'n_benevoles'    => 'required|integer|min:1',
            'date'           => 'required|date|after_or_equal:today',
            'lieu'           => 'required|string',
            'categorie'      => 'required|in:education,social,sante,culture,envirennement',
            'association_id' => 'required',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if (!auth()->check()) {
            return response()->json(['message' => 'Non autorisé'], 401);
        }

        $mission = new Mission($validated);
        $mission->association_id = $request->association_id;

        // Upload image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('missions', 'public');
            $mission->image = $path;
        }

        $mission->save();

        return response()->json([
            'message' => 'Mission créée avec succès !',
            'mission' => $mission,
        ], 201);
    }

    /**
     * Get single mission details
     */
    public function show($id)
    {
        $mission = Mission::with(['association', 'candidatures.benevole'])->findOrFail($id);
        return response()->json($mission);
    }

    /**
     * Update an existing mission
     */
    public function update(Request $request, $id)
    {
        $mission = Mission::findOrFail($id);

        $validated = $request->validate([
            'titre'          => 'required|string|max:255',
            'description'    => 'required|string',
            'n_benevoles'    => 'required|integer|min:1',
            'date'           => 'required|date|after_or_equal:today',
            'lieu'           => 'required|string',
            'categorie'      => 'required|in:education,social,sante,culture,envirennement',
            'association_id' => 'required',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);


        if ($request->hasFile('image')) {
            if ($mission->image && Storage::disk('public')->exists($mission->image)) {
                Storage::disk('public')->delete($mission->image);
            }
            $path = $request->file('image')->store('missions', 'public');
            $validated['image'] = $path;
        }

        $mission->update($validated);

        return response()->json([
            'message' => 'Mission mise à jour !',
            'mission' => $mission,
        ]);
    }

    /**
     * Delete a mission
     */
    public function destroy($id)
    {
        $mission = Mission::findOrFail($id);
        if ($mission->image && Storage::disk('public')->exists($mission->image)) {
            Storage::disk('public')->delete($mission->image);
        }

        $mission->delete();

        return response()->json([
            'message' => 'Mission supprimée avec succès',
        ]);
    }

    /**
     * Missions par association
     */
    public function getByAssociation($id)
    {
        $missions = Mission::where('association_id', $id)
            ->withCount(['candidatures as vols' => function($query){
                $query->where('statut', 'accepter');
            }])->get();

        return response()->json($missions);
    }

    /**
     * Missions actives (statut disponible + date >= aujourd'hui)
     */
    public function getMissionsActives()
    {
        $missions = Mission::where('statut', 'disponible')
            ->where('date', '>=', now()->toDateString())
            ->with('association')
            ->withCount(['candidatures as vols' => function($query){
                $query->where('statut', 'accepter');
            }])
            ->get();

        return response()->json($missions);
    }

    /**
     * Missions par association (version simple)
     */
    public function getMissionsAssociation($association_id)
    {
        $missions = Mission::where('association_id', $association_id)->get();
        return response()->json($missions);
    }

    /**
     * Archiver une mission
     */
    public function archiverMission($id)
    {
        $mission = Mission::findOrFail($id);
        $mission->update(['statut' => 'archive']);

        return response()->json([
            'message' => 'Mission archivée avec succès',
            'mission' => $mission,
        ]);
    }
}