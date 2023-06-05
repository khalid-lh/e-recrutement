<?php

namespace App\Http\Controllers;
Use PDF;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\postuler as ModelsPostuler;
use App\Models\User as ModelsUser;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use App\Models\offre as ModelsOffre;
use Illuminate\Support\Facades\Auth;

class PostulerController extends Controller
{
    public function postuler(Request $request)
    {
    
    
    
        $user= JWTAuth::setToken($request->query('token'))->authenticate();

    $existingData = ModelsPostuler::where('id', $user->id)->where('id_offre', $request->query('id'))->first();
    $offreDetaille = ModelsOffre::where('id_offre', $request->query('id'))->with('company')->first();
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
            $postuler= new ModelsPostuler;
            $postuler->id=$user->id;
            $postuler->id_offre=$request->query('id');
    
            $saved = $postuler->save();
            if($saved){
                $data = [
                    'name'=>$user->name,
                    'company'=>$offreDetaille->company->company_name,
                    'offre_name'=>$offreDetaille->titre_offre,
                    'date'=>$postuler->created_at,
                    'type'=>'postulement',
                    'subject' => 'candidature pour le post "'. $offreDetaille->titre_offre .'"',
                ];
                Mail::to($user->email)->send(new SendMail($data));
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
            'Offrescondidatures'=> $Offrescondidatures
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
        $postule = ModelsPostuler::where('postule_id',$id)->get();
        if($postule){
            $postule->delete(); 
        }
        return response()->json(['message' => 'postule deleted successfully']);
    }
}
