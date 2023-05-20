<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\offre as ModelsOffre;
use App\Models\company as ModelsCompany;
class RecruteurController extends Controller
{
    
    public function statistiques(Request $request)
    {
        $token = substr($request->header('Authorization'), 7);
        $token=$request->header('Authorization');
        $token=str_replace('Bearer ', '', $token);
        $user=JWTAuth::setToken($token)->authenticate();
        try{
        $Stagecount=ModelsOffre::where('id_recruteur', $user->id)->where('type_offre','Stage')->count();
        $Emploicount=ModelsOffre::where('id_recruteur', $user->id)->where('type_offre','Emploi')->count();

        
            return response()->json([ 
                'StageCount' => $Stagecount,
                'EmploiCount' => $Emploicount,
            ]);
        
        }catch (JWTException $e) {
            // Handle JWTException
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function getProfilbyuser(Request $request)
    {
        $token = substr($request->header('Authorization'), 7);
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $user = JWTAuth::setToken($token)->authenticate();
        $company = ModelsCompany::where('id_recruteur', $user->id)->get();
        
        return response()->json(
            [
            'company' => $company, 
            ]
        );
    }
    public function updatcompany(Request $request)
    {
        $token = substr($request->header('Authorization'), 7);
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $user = JWTAuth::setToken($token)->authenticate();
        $company = ModelsCompany::where('id_recruteur', $user->id)->first();
        
if($company){
    $company->ville = $request->input('ville');
    $company->telephone = $request->input('telephone');
    $company->code_postal = $request->input('code_postal');
    $company->description = $request->input('description');
    $company->update();
    return response()->json(['message' => 'Company information updated successfully.']);
}else{
    return response()->json(['message' => 'Company not found.'], 404);
}
    }

    public function update_logo(Request $request)
{
    $request->validate([
        'logo'=>['required','image','mimes:jpeg,png,jpg', 'max:2048']
    ]);
    $token = substr($request->header('Authorization'), 7);
    $token = $request->header('Authorization');
    $token = str_replace('Bearer ', '', $token);
    $user = JWTAuth::setToken($token)->authenticate();
        $company = ModelsCompany::where('id_recruteur', $user->id)->first();
        if ($company) {
            if ($request->hasFile('logo')) {
                // Delete the existing logo if it exists
                if (Storage::disk('public')->exists('images/'.$company->photo)) {
                    Storage::disk('public')->delete('images/'.$company->photo);
                }
                
                // Upload the new logo
                $image = $request->file('logo');
                $imageName = time() . '_' . $image->getClientOriginalName();
                Storage::disk('public')->put('images/'.$imageName, file_get_contents($image));
                dd($imageName);
                // Update the company's photo field with the new image name
                $company->photo = $imageName;
                $company->save();
                
                return response()->json(['message' => 'Company logo updated successfully.']); 
            }
        }else{
        return response()->json(['message' => 'Company not']);

    }
}

}
