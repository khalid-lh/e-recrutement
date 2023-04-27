<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Connexion',[\App\Http\Controllers\UserController::class,'login']);

Route::post('Register/condidat',[\App\Http\Controllers\UserController::class,'register_condidat']);
Route::post('Register/recruteur',[\App\Http\Controllers\UserController::class,'register_recruteur']);


