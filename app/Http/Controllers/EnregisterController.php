<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User as ModelsUser;
use App\Models\offre as ModelsOffre;
use App\Models\postuler as ModelsPostuler;
use Illuminate\Support\Facades\Auth;
use App\Models\enregister as ModelsEnregistrer;
class EnregisterController extends Controller
{
   public function enregistrer_offre(Request $request)
    {
       

    
    $user=Auth::user() ;
    if($user==null){
        return response()->json([
            'message' => 'You need to be logged in to postuler',
        ]);
    }else{
        $existingData = ModelsEnregistrer::where('id', $user->id)->where('id_offre', $request->query('id'))->first();
    if ($user->user_type !== 'condidat') {
        return response()->json([
            'message' => 'You do not have the privilege to postuler.',
        ]);
    }
    if ($existingData) {
        // Data already exists, return error message
        return response()->json([ 
            'message'=> 'Data already exists.'
    ]);
    }else{
        $enregistrer= new ModelsEnregistrer();
        $enregistrer->id=$user->id;
        $enregistrer->id_offre=$request->query('id');
        $saved = $enregistrer->save();
        if($saved){
            return response()->json([
                'message'=> 'Votre enregistrement a été bien enregistrer', 
            ]);   
        }else{
            return response()->json([
                'message'=> 'Votre enregistrement n\'est pas  bien enregistrer', 
            ]); 
        }
    }
}
    }
    public function getmesenregistrements(Request $request)
    {
        $token= substr($request->header('Authorization'), 7);
        $token= $request->header('Authorization');
        $token= str_replace('Bearer ', '', $token);
        $user= JWTAuth::setToken($token)->authenticate();
        $mesenregistrements = ModelsEnregistrer::where('id',$user->id)
        ->with('offre')
        ->withCount('offre')
        ->get();
        return response()->json([
            'mesenregistrements'=> $mesenregistrements,   
        ]);
    }
    public function statistiques(Request $request)
    {
        $token = substr($request->header('Authorization'), 7);
        $token=$request->header('Authorization');
        $token=str_replace('Bearer ', '', $token);
        $user=JWTAuth::setToken($token)->authenticate();
        $id=$user->id;
        try{
        $Postulercount=ModelsPostuler::where('id', $id)->count();
        $Enregistrementcount=ModelsEnregistrer::where('id', $id)->count();
      

            return response()->json([ 
                'PostulerCount' => $Postulercount,
                'EnregistrementCount' => $Enregistrementcount,
                
            ]);
        
        }catch (JWTException $e) {
            // Handle JWTException
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
