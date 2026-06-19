<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CandidatureController extends Controller

{
    // Postuler
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mission_id' => 'required|exists:missions,id',
            'benevole_id' => 'required|exists:benevoles,id', 
            'message' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Check si déjà postulé 
        $exists = Candidature::where('mission_id', $request->mission_id)
            ->where('benevole_id', $request->benevole_id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Vous avez déjà postulé à cette mission'], 422);
        }

        $candidature = Candidature::create([
            'mission_id' => $request->mission_id,
            'benevole_id' => $request->benevole_id,
            'message' => $request->message,
            'statut' => 'en_attente' 
        ]);

        return response()->json([
            'message' => 'Candidature envoyée avec succès',
            'data' => $candidature
        ], 201);
    }


    public function getBenevoleCandidatures($id)
    {
        $candidatures = Candidature::with('mission.association')
            ->where('benevole_id', $id)
            ->get();
            
        return response()->json($candidatures);
    }

    public function getAssociationDemandes($association_id)
    {
        $demandes = Candidature::with(['mission', 'benevole'])
        ->whereHas('mission', function($query) use ($association_id) {
            $query->where('association_id', $association_id);
        })->get();

        return response()->json($demandes);
    }

    public function updateStatut(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'statut' => 'required|in:accepter,refuse,en_attente'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $candidature = Candidature::findOrFail($id);
        $candidature->update(['statut' => $request->statut]);

        return response()->json([
            'message' => 'Statut mis à jour avec succès',
            'data' => $candidature
        ]);
    }
}