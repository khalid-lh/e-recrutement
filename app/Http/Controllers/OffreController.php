<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offre as ModelsOffre;
use App\Models\company as ModelsCompany;
use Auth;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class OffreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['add_offre','getOffres','deleteOffre','update_offre','show_offre','searchOffers','getAllOffers']]);
    }
    public function add_offre(Request $request)
    {
        $token = substr($request->header('Authorization'), 7);
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $user = JWTAuth::setToken($token)->authenticate();
        $company =  ModelsCompany::where('id_recruteur',$user->id)->first();
        $request->validate([
            'titre_offre' => ['required ','string','max:255'],
            'description' => ['required ','string'],
            'n_postes' => ['required','integer'],
            'type_offre' => ['required ','string'],
        ]);
            $offre = new ModelsOffre;
            $offre->id_recruteur = $user->id;
            $offre->titre_offre = $request->input('titre_offre');
            $offre->description = $request->input('description');
            $offre->n_postes = $request->input('n_postes');
            $offre->status = 'close';
            $titre = Str::slug($offre->titre_offre, '-');
            $slug = $company->company_id. '-' . $titre;
            $offre->slug = $slug;
            $offre->type_offre = $request->input('type_offre');
            $offre->presence = $request->input('presence');
            if ($request->input('type_offre') === 'Stage'){
                $request->validate([
                    'duree' => ['required','string'],
                    'convention' => ['required','string'],
                    'presence' => ['required','string'],
                ]);
                $offre->duree = $request->input('duree');
                $offre->convention = $request->input('convention');
                $offre->company_id=$company->company_id;

            }else if($request->input('type_offre') === 'Emploi') {
                $request->validate([
                    'annee_experience' => ['required','integer'],
                    'presence' => ['required','string'],
                ]);
                $offre->annee_experience = $request->input('annee_experience');
                $offre->company_id=$company->company_id;

            }
            try{
                DB::beginTransaction();
                $offre->save();  
                DB::commit();
            }catch(\Throwable $e){
                DB::rollback();
                return response()->json([
                    'message' => '',
                    'error' => $e->getMessage()
                ],500);
            }
    }  

public function getOffres(Request $request)
    {
        $token = substr($request->header('Authorization'), 7);
        $token=$request->header('Authorization');
        $token=str_replace('Bearer ', '', $token);
        $user=JWTAuth::setToken($token)->authenticate();
        $offres = ModelsOffre::where('id_recruteur', $user->id )->get();
    
        return response()->json([
            'offres' => $offres, 
            ]);
        
    }
    public function deleteOffre($id)
    {
        $offre = ModelsOffre::find($id);

        if (!$offre) {
            // Offer not found
            return response()->json(['error' => 'Offer not found'], 404);
        }

        // Delete the offer
        $offre->delete();

        // Return a success response
        return response()->json(['message' => 'Offer deleted successfully']);
    }
   

    public function update_offre($id, Request $request)
{
        $request->validate([
            'titre_offre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'n_postes' => ['required', 'integer'],
            'type_offre' => ['required', 'string'],
        ]);
        $offer = ModelsOffre::findOrFail($id);
        $offer->titre_offre = $request->input('titre_offre');
        $offer->description = $request->input('description');
        $offer->n_postes = $request->input('n_postes');
        $offer->presence = $request->input('presence');
        if($offer->type_offre === 'Stage'){
            $request->validate([
                'duree' => ['required','string'],
                'convension' => ['required','string'],
                'presence' => ['required','string'],
            ]);
            $offer->duree = $request->input('duree');
            $offer->convension = $request->input('convension');
        }else if($offer->type_offre === 'Emploi'){
            $request->validate([
                'annee_experience' => ['required','integer'],
                'presence' => ['required','string'],
            ]);
            $offer->annee_experience = $request->input('annee_experience');
        }
        try{
            DB::beginTransaction();
            $offer->update();
            DB::commit();
            return response()->json(['message_succes' => 'Offer updated successfully']);

        }catch(\Throwable $e){
            DB::rollback();
            return response()->json([
                'message' => '',
                'error' => $e->getMessage()
            ],500);
        }
}

public function getAllOffers()
{
    $offers = ModelsOffre::with('company')->get();
    foreach ($offers as $offer) {
        $limitedDescription = Str::limit($offer->description, 80);
        $offer->description = $limitedDescription;
    }
    return response()->json([
        'offers'=> $offers, 
    ]   
    );
}
public function show_offre(Request $request)
{
    $id= $request->query('key');
    $slug = $request->query('slug');
    $offer = ModelsOffre::with('company')->where('id_offre',$id)->where('slug',$slug)->firstOrFail();
    return view('showOffre')->with([
        'offre'=>$offer
    ]);
}
public function searchOffers(Request $request)
    {
        $metier = $request->query('metier');
        $ville = $request->query('ville');
        $offers = ModelsOffre::with('company')
        ->join('companies', 'offres.company_id', '=', 'companies.company_id')
        ->where(function ($query) use ($metier) {
            $query->where('offres.titre_offre', 'LIKE', '%' . $metier . '%')
                ->orWhere('offres.description', 'LIKE', '%' . $metier . '%');
        })
        ->where('companies.ville', $ville)
        ->get();
       

        return view('listOffresearched')->with([
            'offres'=>$offers
        ]);
        
    }

}
