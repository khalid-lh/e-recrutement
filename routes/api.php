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
Route::get('/logout',[\App\Http\Controllers\UserController::class,'deconnexion'])->name('deconnexion');
Route::get('/getUserType',[\App\Http\Controllers\UserController::class,'getUserTypeFromDatabase']);
//Recruteur
Route::post('/recruteur/addoffre',[\App\Http\Controllers\OffreController::class,'add_offre']);
Route::get('/recruteur/dashboard/statistiques',[\App\Http\Controllers\RecruteurController::class,'statistiques']);
Route::get('/recruteur/profil/getinfos', [\App\Http\Controllers\RecruteurController::class,'getProfilbyuser']);
Route::put('/recruteur/profil/updatcompany', [\App\Http\Controllers\RecruteurController::class,'updatcompany']);
Route::get('/recruteur/dashbaord/getoffres', [\App\Http\Controllers\OffreController::class,'getOffres']);
Route::delete('/recruteur/dashboard/deleteoffre/{id}',[\App\Http\Controllers\OffreController::class,'deleteOffre']);
Route::put('/recruteur/dashboard/modifyoffre/{id}',[\App\Http\Controllers\OffreController::class,'update_offre']);
Route::post('/recruteur/profil/updatelogo',[\App\Http\Controllers\RecruteurController::class,'update_logo']);
Route::get('/home_offers',[\App\Http\Controllers\OffreController::class,'gethomeOffers']);
Route::get('/offre_emploi',[\App\Http\Controllers\OffreController::class,'show_offre']);
Route::get('/rechercher/offres',[\App\Http\Controllers\OffreController::class,'searchOffers'])->name('search.offers');;
Route::post('/postuler_offres', [\App\Http\Controllers\PostulerController::class , 'postuler']);
Route::get('/recruteur/Offrescondidatures', [\App\Http\Controllers\PostulerController::class , 'getoffres_condidats']);
Route::get('/recruteur/mescondidaturs/{id}', [\App\Http\Controllers\PostulerController::class , 'getMescondidatures']);
Route::get('/recruteur/mesoffresdeleted', [\App\Http\Controllers\OffreController::class , 'getmesoffresdeleted']);
Route::delete('/recruteur/dashboard/forcedelete/{id}',[\App\Http\Controllers\OffreController::class,'forcedeleteOffre']);
Route::patch('/recruteur/dashboard/restoreOffre/{id}',[\App\Http\Controllers\OffreController::class,'restoreOffre']);

/*Route::get('/mescondidaturs/cv-condidature',[\App\Http\Controllers\PostulerController::class,'showcvcondidature']);
Route::get('/downloadcv/{cv}',[\App\Http\Controllers\PostulerController::class,'downloadCV']);*/

//Condidat
Route::get('/condidat/profil/getinfos', [\App\Http\Controllers\condidatController::class,'getProfilcondidat']);
Route::put('/condidat/profil/updatecondidat', [\App\Http\Controllers\condidatController::class,'updatecondidat']);
Route::post('/condidat/profil/updatephoto',[\App\Http\Controllers\condidatController::class,'update_photo']);
Route::get('/condidat/mescondidatures',[\App\Http\Controllers\condidatController::class,'mescondidature']);
Route::post('/condidat/profil/updatecv',[\App\Http\Controllers\condidatController::class,'update_cv']);
Route::post('/send-email',[\App\Http\Controllers\RecruteurController::class,'send_email']);
Route::delete('/condidat/dashboard/deletepostule/{id}',[\App\Http\Controllers\PostulerController::class,'deletePostulersOffre']);
Route::post('/enregistrer_offre', [\App\Http\Controllers\EnregisterController::class , 'enregistrer_offre']);
Route::get('/condidat/mesenregistrements', [\App\Http\Controllers\EnregisterController::class , 'getmesenregistrements']);
Route::get('/condidat/dashboard/statistiques',[\App\Http\Controllers\EnregisterController::class,'statistiques']);
//Admin
Route::get('/admin/dashboard/statistiques',[\App\Http\Controllers\AdminController::class,'statistiques']);
Route::get('/admin/getallOffers',[\App\Http\Controllers\OffreController::class,'getallOffers']);
Route::get('/admin/getallcompanies',[\App\Http\Controllers\CompanieController::class,'getallcompanies']);
Route::post('/admin/addPost',[\App\Http\Controllers\PostController::class,'add_post']);
Route::get('/admin/getallposts',[\App\Http\Controllers\PostController::class,'getallposts']);
Route::delete('/admin/deletepost/{id}',[\App\Http\Controllers\PostController::class,'deletepost']);
Route::get('/getPost/{id}',[\App\Http\Controllers\PostController::class,'getpost']);
Route::post('/admin/modifypost/{id}',[\App\Http\Controllers\PostController::class,'updatePost']);
Route::patch('/admin/restorepost/{id}',[\App\Http\Controllers\PostController::class,'restorepost']);
Route::get('/admin/mespostsdeleted',[\App\Http\Controllers\PostController::class,'getpostsTrashed']);
Route::post('/admin/allcompanies/validercompany/{id}',[\App\Http\Controllers\CompanieController::class,'valider_companie']);
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Connexion',[\App\Http\Controllers\UserController::class,'login']);
Route::post('Register/condidat',[\App\Http\Controllers\UserController::class,'register_condidat']);
Route::post('Register/recruteur',[\App\Http\Controllers\UserController::class,'register_recruteur']);
Route::get('/logout',[\App\Http\Controllers\UserController::class,'deconnexion'])->name('deconnexion');
Route::get('/getUserType',[\App\Http\Controllers\UserController::class,'getUserTypeFromDatabase']);
Route::get('/home_offers',[\App\Http\Controllers\OffreController::class,'gethomeOffers']);
Route::get('/offre_emploi',[\App\Http\Controllers\OffreController::class,'show_offre']);
Route::get('/rechercher/offres',[\App\Http\Controllers\OffreController::class,'searchOffers'])->name('search.offers');;
Route::middleware('auth:api')->group(function () {
    // Recruteur
    Route::prefix('recruteur')->group(function () {
        Route::post('/recruteur/addoffre',[\App\Http\Controllers\OffreController::class,'add_offre']);
Route::get('/recruteur/dashboard/statistiques',[\App\Http\Controllers\RecruteurController::class,'statistiques']);
Route::get('/recruteur/profil/getinfos', [\App\Http\Controllers\RecruteurController::class,'getProfilbyuser']);
Route::put('/recruteur/profil/updatcompany', [\App\Http\Controllers\RecruteurController::class,'updatcompany']);
Route::get('/recruteur/dashbaord/getoffres', [\App\Http\Controllers\OffreController::class,'getOffres']);
Route::delete('/recruteur/dashboard/deleteoffre/{id}',[\App\Http\Controllers\OffreController::class,'deleteOffre']);
Route::put('/recruteur/dashboard/modifyoffre/{id}',[\App\Http\Controllers\OffreController::class,'update_offre']);
Route::post('/recruteur/profil/updatelogo',[\App\Http\Controllers\RecruteurController::class,'update_logo']);

Route::post('/postuler_offres', [\App\Http\Controllers\PostulerController::class , 'postuler']);
Route::get('/recruteur/Offrescondidatures', [\App\Http\Controllers\PostulerController::class , 'getoffres_condidats']);
Route::get('/recruteur/mescondidaturs/{id}', [\App\Http\Controllers\PostulerController::class , 'getMescondidatures']);
Route::get('/recruteur/mesoffresdeleted', [\App\Http\Controllers\OffreController::class , 'getmesoffresdeleted']);
Route::delete('/recruteur/dashboard/forcedelete/{id}',[\App\Http\Controllers\OffreController::class,'forcedeleteOffre']);
Route::patch('/recruteur/dashboard/restoreOffre/{id}',[\App\Http\Controllers\OffreController::class,'restoreOffre']);
    });

    // Condidat
    Route::prefix('condidat')->group(function () {
        Route::get('/condidat/profil/getinfos', [\App\Http\Controllers\condidatController::class,'getProfilcondidat']);
Route::put('/condidat/profil/updatecondidat', [\App\Http\Controllers\condidatController::class,'updatecondidat']);
Route::post('/condidat/profil/updatephoto',[\App\Http\Controllers\condidatController::class,'update_photo']);
Route::get('/condidat/mescondidatures',[\App\Http\Controllers\condidatController::class,'mescondidature']);
Route::post('/condidat/profil/updatecv',[\App\Http\Controllers\condidatController::class,'update_cv']);
Route::post('/send-email',[\App\Http\Controllers\RecruteurController::class,'send_email']);
Route::delete('/condidat/dashboard/deletepostule/{id}',[\App\Http\Controllers\PostulerController::class,'deletePostulersOffre']);
Route::post('/enregistrer_offre', [\App\Http\Controllers\EnregisterController::class , 'enregistrer_offre']);
Route::get('/condidat/mesenregistrements', [\App\Http\Controllers\EnregisterController::class , 'getmesenregistrements']);
Route::get('/condidat/dashboard/statistiques',[\App\Http\Controllers\EnregisterController::class,'statistiques']);
    });

    // Admin
    Route::prefix('admin')->group(function () {
        Route::get('/admin/dashboard/statistiques',[\App\Http\Controllers\AdminController::class,'statistiques']);
Route::get('/admin/getallOffers',[\App\Http\Controllers\OffreController::class,'getallOffers']);
Route::get('/admin/getallcompanies',[\App\Http\Controllers\CompanieController::class,'getallcompanies']);
Route::post('/admin/addPost',[\App\Http\Controllers\PostController::class,'add_post']);
Route::get('/admin/getallposts',[\App\Http\Controllers\PostController::class,'getallposts']);
Route::delete('/admin/deletepost/{id}',[\App\Http\Controllers\PostController::class,'deletepost']);
Route::get('/getPost/{id}',[\App\Http\Controllers\PostController::class,'getpost']);
Route::post('/admin/modifypost/{id}',[\App\Http\Controllers\PostController::class,'updatePost']);
Route::patch('/admin/restorepost/{id}',[\App\Http\Controllers\PostController::class,'restorepost']);
Route::get('/admin/mespostsdeleted',[\App\Http\Controllers\PostController::class,'getpostsTrashed']);
Route::post('/admin/allcompanies/validercompany/{id}',[\App\Http\Controllers\CompanieController::class,'valider_companie']);  
});
});*/