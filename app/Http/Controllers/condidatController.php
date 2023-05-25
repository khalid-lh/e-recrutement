<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User as Modelsuser;
use App\Models\Profil as ModelsProfil;
use App\Models\postuler as ModelsPostuler;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTime;
class condidatController extends Controller
{
    public function getProfilcondidat(Request $request)
    {
        $token = substr($request->header('Authorization'), 7);
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $user = JWTAuth::setToken($token)->authenticate();
        $condidat = ModelsProfil::where('user_id', $user->id)->with('user')->get();
        
        return response()->json(
            [
            'condidat' => $condidat, 
            ]
        );
    }
    public function updatecondidat(Request $request)
    {
        $token = substr($request->header('Authorization'), 7);
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $user = JWTAuth::setToken($token)->authenticate();
        $profil = ModelsProfil::where('user_id', $user->id)->first();
        
if($profil){
    $profil->ville = $request->input('ville');
    $profil->telephone = $request->input('telephone');
    $profil->pays = $request->input('pays');
    $profil->update();
    return response()->json(['message' => 'condidat information updated successfully.']);
}else{
    return response()->json(['message' => 'condidat not found.'], 404);
}
    }
    public function update_photo(Request $request)
{
    $request->validate([
        'photo'=>['required','image','mimes:jpeg,png,jpg', 'max:2048']
    ]);
    $token = substr($request->header('Authorization'), 7);
    $token = $request->header('Authorization');
    $token = str_replace('Bearer ', '', $token);
    $user = JWTAuth::setToken($token)->authenticate();
        $profil = ModelsProfil::where('user_id', $user->id)->first();
        if ($profil){
            if ($request->has('photo')) {
                // Delete the existing logo if it exists
                if(Storage::disk('public')->exists('images/'.$profil->photo)) {
                    Storage::disk('public')->delete('images/'.$profil->photo);
                }
                $image = $request->file('photo');
                $imageName = time() . '_' . $image->getClientOriginalName();
                Storage::disk('public')->put('images/'.$imageName, file_get_contents($image));
                $profil->photo = $imageName;
                $profil->update();
                return response()->json(['message' => 'photo updated successfully.']); 
            }else{
                return response()->json(['message' => 'khawi']);
            }
        }else{
        return response()->json(['message' => 'profil not found']);
    }
}
    public function mescondidature(Request $request)
    {
        $token= substr($request->header('Authorization'), 7);
        $token= $request->header('Authorization');
        $token= str_replace('Bearer ', '', $token);
        $user= JWTAuth::setToken($token)->authenticate();
        $mescondidatures = ModelsPostuler::where('id', $user->id)
    ->with(['offre' => function ($query) {
        // Include both trashed and non-trashed offres
        $query->withTrashed();
    }])
    ->get();
        return response()->json([
            'mescondidatures'=> $mescondidatures,   
        ]);
    }

public function calculatedate($data){

    foreach ($data as $item){
        $item['created_at'] = Carbon::parse($item['created_at']); 
        $diff =  $item['created_at']->diffForHumans(Carbon::now());
        $item['created_at'] = $diff;
    }
    
    return $data;
}

   
public function update_cv(Request $request)
{
    $request->validate([
        'cv'=>['required','mimes:pdf', 'max:2048']
    ]);
    $token = substr($request->header('Authorization'), 7);
    $token = $request->header('Authorization');
    $token = str_replace('Bearer ', '', $token);
    $user = JWTAuth::setToken($token)->authenticate();
        $profil = ModelsProfil::where('user_id', $user->id)->first();
        if ($profil){
            if($request->has('cv')){
                // Delete the existing logo if it exists
                if(Storage::disk('public')->exists('pdfs/'.$profil->cv)){
                    Storage::disk('public')->delete('pdfs/'.$profil->cv);
                }
                $cv = $request->file('cv');
                $cvName = time() . '_' . $cv->getClientOriginalName();
                Storage::disk('public')->put('pdfs/'.$cvName, file_get_contents($cv));
                $profil->cv= $cvName;
                $profil->update();
                return response()->json(['message' => 'cv updated successfully.']); 
            }else{
                return response()->json(['message' => 'khawi']);
            }
        }else{
        return response()->json(['message' => 'profil not found']);
    }
}
}
