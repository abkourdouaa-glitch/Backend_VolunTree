<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Barryvdh\DomPDF\Facade\Pdf;

class PassBenevoleController extends Controller
{
    public function generate($id)
    {
        $candidature = Candidature::with([
            'mission',
            'mission.association',
            'benevole'
        ])->findOrFail($id);

        if ($candidature->statut !== 'accepter') {
            return response()->json([
                'message' => 'Pass disponible uniquement pour les candidatures acceptées.'
            ], 403);
        }

        $pdf = Pdf::loadView('pdf.pass-benevole', [
            'mission'     => $candidature->mission,
            'association' => $candidature->mission->association,
            'benevole'    => $candidature->benevole,
            'candidature' => $candidature,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('pass-benevole.pdf');
    }
}
