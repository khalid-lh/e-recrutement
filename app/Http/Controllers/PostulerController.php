<?php

namespace App\Http\Controllers;
Use PDF;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\postuler as ModelsPostuler;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Storage;

use App\Models\offre as ModelsOffre;
class PostulerController extends Controller
{
    public function postuler(Request $request)
    {
        /*$token= substr($request->header('Authorization'), 7);
        $token= $request->header('Authorization');
        $token= str_replace('Bearer ', '', $token);*/
        $user= JWTAuth::setToken($request->query('token'))->authenticate();

    $existingData = ModelsPostuler::where('id', $user->id)->where('id_offre', $request->query('id'))->first();

    if ($existingData) {
        // Data already exists, return error message
        return response()->json([ 
            'message'=> 'Data already exists.'
    ]);
    }else{
        $postuler= new ModelsPostuler;
        $postuler->id=$user->id;
        $postuler->id_offre=$request->query('id');

        $saved = $postuler->save();
        if($saved){
            return response()->json([
                'message'=> 'Votre condidature a été bien enregistrer', 
            ]);   
        }else{
            return response()->json([
                'message'=> 'Votre condidature n\'est pas  bien enregistrer', 
            ]); 
        }
    }
        
    }
    public function getoffres_condidats(Request $request)
    {
        $token= substr($request->header('Authorization'), 7);
        $token= $request->header('Authorization');
        $token= str_replace('Bearer ', '', $token);
        $user= JWTAuth::setToken($token)->authenticate();
        $Offrescondidatures = ModelsOffre::where('id_recruteur', $user->id)
        ->with('postulers')
        ->with(['postulers.user'])
        ->withCount('postulers')
        ->get();
        return response()->json([
            'Offrescondidatures'=> $Offrescondidatures,   
        ]);
    }
    public function getMescondidatures($id)
    {
        $mescondidatures = ModelsPostuler::where('id_offre', $id)
    ->with('user')
    ->with(['user.profil'])
    ->get();

$modifiedData = [];
foreach ($mescondidatures as $postuler) {
    $idOffre = $postuler->id_offre;
    if(!isset($modifiedData[$idOffre])){
        $modifiedData[$idOffre] = [
            'postule_id' => $postuler->postule_id,
            'id_offre' => $idOffre,
            'users' => [],
            
        ];
    }
    $modifiedData[$idOffre]['users'][] = $postuler->user;
}

    $finalData = array_values($modifiedData);
        return response()->json([
            'mescondidatures'=> $finalData,  
        ]);
    }
    public function deletePostulersOffre($id)
    {
        $postule = ModelsPostuler::findOrFail($id);
        
        $postule->delete();  
        return response()->json(['message' => 'postule deleted successfully']);
    }
}
