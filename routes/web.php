<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
Route::get('/', function (){
    return view('welcome');
})->name('index');

Route::get('/about', function (){
    return view('about');
});
Route::get('/login', function (){
    return view('Auth/login');
})->name('login');

Route::get('/Register', function (){
    return view('Auth/register');
});
Route::get('/Publications', function (){
    return view('allpublications');
});
Route::get('/admin/dashboard', function (){
    return view('Admin/admindashboard');
});

Route::get('/recruteur/dashboard', function (){
    return view('recruteurdashboard');
});

Route::get('/recruteur/{path}', function (){
    return view('recruteurdashboard');
})->where('path', '(.*)');
Route::get('/candidat/{path}', function (){
    return view('Condidat/condidatdashboard');
})->where('path', '(.*)');
Route::get('/candidat/dashboard', function (){
    return view('Condidat/condidatdashboard');
});
Route::get('/admin/{path}', function (){
    return view('Admin/admindashboard');
})->where('path', '(.*)');
Route::get('/verificationEmailSuccess', function (){
    return view('verificationEmailSuccess');
});
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

/*Route::group(['middleware' => 'auth:api'], function (){
    //add more Routes here
    
});*/
/*Route::middleware(['auth'])->group(function(){
    Route::get('/recruteur/dashboard', [App\Http\Controllers\UserController::class, 'index']);
});*/

//Route::get('/recruteur/{path}','App\Http\Controllers\UserController@index')->where('path','([A-z\d\-\/_.]+)?');
//Route::get('/recruteur/{path}', [App\Http\Controllers\UserController::class, 'index'])->where('path', '.*');
//Route::get('/recruteur/{path}', [\App\Http\Controllers\UserController::class, 'index'])->where('path', '[A-Za-z\d\-\/_,]+?');
