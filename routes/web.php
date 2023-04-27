<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//pages 

Route::get('/', function (){
    return view('welcome');
});

Route::get('/about', function (){
    return view('about');
});
Route::get('/login', function (){
    return view('Auth/login');
});
Route::get('/Register', function (){
    return view('Auth/register');
});
Route::get('/admin/dashboard', function (){
    return view('Admin/admindashboard');
});
Route::get('/recruteur/dashboard', function (){
    return view('/recruteurdashboard');
});
//Authentication

Route::post('/Connexion',[\App\Http\Controllers\UserController::class,'login']);
