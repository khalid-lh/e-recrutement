<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Connexion',[\App\Http\Controllers\UserController::class,'login']);
Route::post('Register/condidat',[\App\Http\Controllers\UserController::class,'register_condidat']);
Route::post('Register/recruteur',[\App\Http\Controllers\UserController::class,'register_recruteur']);
//Recruteur
Route::post('/recruteur/addoffre',[\App\Http\Controllers\OffreController::class,'add_offre']);
Route::get('/recruteur/dashboard/statistiques',[\App\Http\Controllers\RecruteurController::class,'statistiques']);
Route::get('/recruteur/profil/getinfos', [\App\Http\Controllers\RecruteurController::class,'getProfilbyuser']);
Route::put('/recruteur/profil/updatcompany', [\App\Http\Controllers\RecruteurController::class,'updatcompany']);
Route::get('/recruteur/dashbaord/getoffres', [\App\Http\Controllers\OffreController::class,'getOffres']);
Route::delete('/recruteur/dashboard/deleteoffre/{id}',[\App\Http\Controllers\OffreController::class,'deleteOffre']);
Route::put('/recruteur/dashboard/modifyoffre/{id}',[\App\Http\Controllers\OffreController::class,'update_offre']);
Route::post('/recruteur/profil/updatelogo',[\App\Http\Controllers\RecruteurController::class,'update_logo']);
Route::get('/home_offers',[\App\Http\Controllers\OffreController::class,'getAllOffers']);
Route::get('/offre_emploi',[\App\Http\Controllers\OffreController::class,'show_offre']);
Route::get('/rechercher/offres',[\App\Http\Controllers\OffreController::class,'searchOffers'])->name('search.offers');;
Route::post('/postuler_offres', [\App\Http\Controllers\PostulerController::class , 'postuler']);
Route::get('/recruteur/Offrescondidatures', [\App\Http\Controllers\PostulerController::class , 'getoffres_condidats']);
Route::get('/recruteur/mescondidaturs/{id}', [\App\Http\Controllers\PostulerController::class , 'getMescondidatures']);
/*Route::get('/mescondidaturs/cv-condidature',[\App\Http\Controllers\PostulerController::class,'showcvcondidature']);
Route::get('/downloadcv/{cv}',[\App\Http\Controllers\PostulerController::class,'downloadCV']);*/
//Condidat
Route::get('/condidat/profil/getinfos', [\App\Http\Controllers\condidatController::class,'getProfilcondidat']);
Route::put('/condidat/profil/updatecondidat', [\App\Http\Controllers\condidatController::class,'updatecondidat']);
Route::post('/condidat/profil/updatephoto',[\App\Http\Controllers\condidatController::class,'update_photo']);
Route::get('/condidat/mescondidatures',[\App\Http\Controllers\condidatController::class,'mescondidature']);
Route::post('/condidat/profil/updatecv',[\App\Http\Controllers\condidatController::class,'update_cv']);



