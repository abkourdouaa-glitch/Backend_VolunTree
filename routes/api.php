<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\BenevoleController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\TokenController;

use App\Http\Controllers\PassBenevoleController;

// --- PROJET DE SYNTHÈSE (Gestion Bénévoles) ---

Route::post('/login', [TokenController::class, 'login']);
Route::post('/inscription-benevole', [BenevoleController::class, 'store']);
Route::post('/inscription-association', [AssociationController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/missions/actives', [MissionController::class, 'getMissionsActives']);
    Route::put('/missions/{id}/archiver', [MissionController::class, 'archiverMission']);


    Route::get('/missions', [MissionController::class, 'index']);
    Route::get('/missions/{id}', [MissionController::class, 'show']);
    Route::get('/missions/association/{id}', [MissionController::class, 'getByAssociation']);
    

    

    Route::get('/candidatures/{id}/pass-pdf', [PassBenevoleController::class, 'generate']);
    Route::post('/logout', [TokenController::class, 'logout']);

    Route::post('/candidatures', [CandidatureController::class, 'store']);
    Route::get('/candidatures/benevole/{id}', [CandidatureController::class, 'getBenevoleCandidatures']);
    Route::get('/candidatures/association/{association_id}', [CandidatureController::class, 'getAssociationDemandes']);
    Route::put('/candidatures/{id}/statut', [CandidatureController::class, 'updateStatut']);

    //Profile 
    Route::get('/benevole/profile', [BenevoleController::class, 'getProfile']);
    Route::post('/benevole/profile', [BenevoleController::class, 'update']);
    Route::put('benevole/profile', [BenevoleController::class, 'update']);

    Route::get('/association/profile', [AssociationController::class, 'getProfile']);
    Route::post('/association/profile', [AssociationController::class, 'update']);

    // Association
    Route::middleware('role:association')->group(function () {
        Route::get('/dashboard-association', [AssociationController::class, 'getData']);
        Route::post('/missions', [MissionController::class, 'store']);
        Route::put('/missions/{id}', [MissionController::class, 'update']);
        Route::delete('/missions/{id}', [MissionController::class, 'destroy']);
    });

    // Benevole
    Route::middleware('role:benevole')->group(function () {
        Route::get('/dashboard-benevole', [BenevoleController::class, 'getData']);
    });

});










    // --- PROJET DE STAGE (Site Vitrine) ---
/*

// Routes publiques (Tout le monde peut voir)
Route::get('/actualites', [ActualiteController::class, 'index']);
Route::get('/actualites/{id}', [ActualiteController::class, 'show']);

// Routes protégées (Connexion + Admin)
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/actualites', [ActualiteController::class, 'store']);
    Route::post('/actualites/{id}', [ActualiteController::class, 'update']);
    Route::put('/actualites/{id}', [ActualiteController::class, 'update']);
    Route::delete('/actualites/{id}', [ActualiteController::class, 'destroy']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
    });
    // Inscriptions (Public)
    Route::post('/login', [AuthController::class, 'login']);

*/