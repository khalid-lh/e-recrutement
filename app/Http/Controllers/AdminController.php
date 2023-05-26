<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\postuler as ModelsPostuler;
use App\Models\offre as ModelsOffre;
use App\Models\company as ModelsCompany;
use App\Models\User as ModelsUsers; 
class AdminController extends Controller
{
    public function statistiques(Request $request)
    {
        try{
        $Stagecount=ModelsOffre::where('type_offre','Stage')->count();        
        $EmploiCount=ModelsOffre::where('type_offre','Emploi')->count(); #
        $UsersCount=ModelsUsers::where('user_type', '<>', 'admin')->count(); 
        $companyCount=ModelsCompany::count(); 
            return response()->json([ 
                'StageCount' => $Stagecount,
                'EmploiCount' => $EmploiCount,
                'companyCount' => $companyCount,
                'UsersCount' => $UsersCount,
            ]);
        
        }catch (JWTException $e) {
            // Handle JWTException
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    
}
