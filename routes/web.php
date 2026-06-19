<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\PrController;
use App\Http\Controllers\AnnonceController;
// use App\Http\Controllers\ClientController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\StageController;

Route::resource('/stages', StageController::class);
Route::resource('/personne', PersonneController::class);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('auth.dashboard');

Route::get('/register', [AuthController::class, 'showRegister'])->middleware('guest')->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'ShowLogin'])->middleware('guest')->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/employee/filtrer', [EmployeeController::class, 'Filtrer'])->name('employee.Filtrer');

Route::get('/employee/{id}/statut', [EmployeeController::class, 'changeStatut'])->name('employee.changeStatut');

Route::resource('/employee',EmployeeController::class );

Route::resource('/piece', PieceController::class);

// Route::resource('/client', ClientController::class);

Route::get('/annonce/dashboard', [AnnonceController::class, 'dashboard'])
->name('annonce.dashboard');


Route::resource('annonce', AnnonceController::class);

Route::resource('stagiaire', StagiaireController::class);


Route::get('/films', [FilmsController::class, 'index'] )
->name('TP7.films');

Route::get('/films/{id}', [FilmsController::class, 'show'])
->name('TP7.show');

Route::get('/films/{id}/acteurs', [FilmsController::class, 'acteursDetail'])
->name('TP7.acteursDetail');



Route::get('/compte', [FormController::class, 'compte'])
->name('FormController.compte');

Route::post('/store2', [FormController::class, 'store2'])
->name('FormController.store2');

Route::get('/ajouter', [FormController::class, 'ajouter'])
->name('Form.ajouter');

Route::post('/FormController.store', [FormController::class, 'store'])
->name('FormController.store');

 Route::get('/create', [ProductController::class, 'create'])
 ->name('Form.create');

Route::post('/Form.store', [ProductController::class, 'store'])
->name('Form.store');

Route::get('Products', [ProductController::class, 'index'])
->name('Products');

Route::get('voir/{id}', [ProductController::class, 'voir'])
->name('layouts.voir');


Route::get('/Home', function () {
    return view('Home');
});

Route::get('/About', function () {
    return view('About');
});
Route::get('/Contact', function () {
    return view('Contact');
});
/*

Route::get('/Home/{result?}', function($result = null){
    return view('View.calculatriceView', compact('result'));
    })->name('Home');
    
    
use Illuminate\Http\Request;

Route::post('/calculer', function(Request $request){
    $a = $request->input('a');
    $b = $request->input('b');
    $op= $request->input('op');

    $result = "";
    switch($op){
        case "+":
           $result = $a + $b;
           break;
        case "-":
            $result = $a - $b;
            break;
        case "*":
            $result = $a * $b;
            break;
        case "/":
            if($b == 0){
                return 'division par 0!!';
            }else{
                $result = $a / $b;
            }
            break;
    }

    return redirect()->route('Home', ['result'=> $result]);
    


});
*/

Route::get('//', function () {
    return view('welcome');
});

//ex1:
Route::get('/', function(){
    return ('home page');
});
// Route::get('/login', function(){
//     return ('login page');
// });
Route::get('/page/{id}', function($id){
    return ('Page numéro : '.$id);
});

Route::get('/test/{param}', function ($param) {
    //return ("param: ". $param);
    return view('welcome', ['param' => $param]);
});
Route::get('/Formation/{formation}/filiere/{filiere}/groupe/{groupe}/stagiaire/{stagiaire}',
      function($formation,$filiere,$groupe,$stagiaire){
        return ("Formation: ".$formation."<br>".
        "Filiere: ".$filiere."<br>".
        "Groupe: ".$groupe."<br>".
        "Stagiaire: ".$stagiaire."<br>");
      });
//ex2:
Route::get('bienvenue', function(){
      return ("Bienvenue sur mon site Laravel !");
});
Route::get("user/{nom}", function($nom){
    return ("Bonjour ".$nom);
});
Route::get("produit/{id}", function($id){
    return ("Détails du produit numéro ".$id);
});

Route::get('calculer/addition/{a}/{b}', function($a,$b){
    $res = $a + $b;
    return ($a." + ".$b." = ".$res);
})->where(['a'=>'[0-9]+', 'b'=>'[0-9]+']);
Route::get('calculer/soustraction/{a}/{b}', function($a,$b){
    $res = $a - $b;
    return ($a." - ".$b." = ".$res);
})->name('soustraction');
Route::get('calculer/multiplication/{a}/{b}', function($a,$b){
    $res = $a * $b;
    return ($a." x ".$b." = ".$res);
});
Route::get('calculer/division/{a}/{b}', function($a,$b){
    if($b != 0){
        $res = $a / $b;
    }else{
        "alert='Division By Zero Error'";
    }
    return ($a." / ".$b." = ".$res);
});

Route::get('/view/{nom}', function($nom){
    return view('test.view', ['nom'=> $nom]); //, compact('nom','prenom'..) == ['nom' =>$nom]
});
//redirect()->route('//name') =>change route