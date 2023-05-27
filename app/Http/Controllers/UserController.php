<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User as ModelsUser;
use App\Models\Profil as ModelsProfil;
use App\Models\company as ModelsCompany;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{

    
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register_condidat','register_recruteur']]);
    }
    public function index()
    {
        return view('recruteurdashboard');
    }
   
    public function login(Request $request)
    {
        $request->validate([
            'email'=>['required'],
            'password'=>['required']
        ]);
        $credentials = request(['email', 'password']);

        if ($token = auth('api')->attempt($credentials)){
        $user=auth('api')->user();
      
        return response()->json([
        'message'=>'kayn',
        'token'=>$token,
         'user'=>$user
        ]);
        }
        return response()->json(['status' => 'error']);
    }

    public function register_condidat(Request $request){

        $request->validate([
            'name'=>['required','','min:5','max:10'],
            'email'=>['required','string','unique:users','email','min:12','max:30'],
            'password'=>['required','string','min:8','max:12'],
            'telephone'=>['required','string'],
            'ville'=>['required','string'],
            'pays'=>['required','string'],
            'cv'=>['required','mimes:pdf', 'max:2048'],
            'image'=>['required','mimes:jpeg,png,jpg', 'max:2048']
        ]);
        $user = new ModelsUser();
        $user->name = $request->name;
        $user->user_type = 'condidat';
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $profil = new ModelsProfil();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
            $profil->photo =  $imageName;
        }
        if($request->hasFile('cv')) {
            $pdf = $request->file('cv');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            Storage::disk('public')->put('pdfs/' . $pdfName, file_get_contents($pdf));
            $profil->cv=$pdfName;
        }
        $profil->telephone = $request->telephone;
        $profil->ville = $request->ville;
        $profil->pays = $request->pays;
       
 
        try {
            DB::beginTransaction();
            $user->save();
            $profil->user_id = $user->id;
            $profil->save();
            DB::commit();
            $data = [
                'subject' => 'Inscription du compte condidature',
                'body'=> 'Votre compte condidat a ete enregistrer avec succes   
                Merci de votre confiance a notre platforme '
            ];
            Mail::to($user->email)->send(new SendMail($data));
        } catch (\Throwable $e) {
            DB::rollback();
            Storage::delete('/storage/images/'.$imageName);
            Storage::delete('/storage/pdfs/'.$pdfName);
            return response()->json([
                'message' => 'An error occurred while registering the user',
                'error' => $e->getMessage()
            ], 500);
        }
    
        if($token = auth('api')->attempt(['email'=> $request->email, 'password'=>$request->password])){
            return response()->json([
                'message' => 'User registered successfully',
                'token' => $token,
                'user' => $user
            ]);
        }else{
            return response()->json([
                'message' => 'An error occurred while authenticating the user'
            ], 401);
        }
    }

    public function register_recruteur(Request $request){   
        
        $imageName='';
        $pdfName='';
        $request->validate([
            'name_recruteur'=>['required','string','min:5','max:10'],
            'email_recruteur'=>['required','string','email','min:12','max:30'],
            'password_recruteur'=>['required','string','min:8','max:12'],
            'name_societe'=>['required','string'],
            'telephone_societe'=>['required','string'],
            'ville_societe'=>['required','string'],
            'pays_societe'=>['required','string'],
            'description'=>['required','string'],
            'code_postal'=>['required','string'],
            'register_commerce'=>['required','mimes:pdf', 'max:2048'],
            'logo'=>['required','mimes:jpeg,png,jpg']
        ]);
        $user=new ModelsUser();
        $user->name=$request->name_recruteur;
        $user->user_type='recruteur';
        $user->email=$request->email_recruteur;
        $user->password=bcrypt($request->password_recruteur);
        $company=new ModelsCompany();
        /*$fileData = base64_decode($request->file('register_commerce'));
        $logo= base64_decode($request->file('logo'));*/
        /*$logo=$request->file('image');
        $imageContent = file_get_contents($logo->getPathname());*/
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '_' . $image->getClientOriginalName();
          Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
            $company->photo =  $imageName;
        }
        if($request->hasFile('register_commerce')) {
            $pdf = $request->file('register_commerce');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            Storage::disk('public')->put('pdfs/' . $pdfName, file_get_contents($pdf));
            $company->register_commerce=$pdfName;
        }
            $company->telephone = $request->telephone_societe;
        $company->company_name=$request->name_societe;
        $company->ville = $request->ville_societe;
        $company->pays = $request->pays_societe;
        $company->code_postal = $request->code_postal;
        $company->description = $request->description;
        try{
            DB::beginTransaction();
            $user->save();
            $company->id_recruteur=$user->id;
            $company->save();
            DB::commit();
            $data = [
 'subject' => 'REGISTRATION DU COMPTE RECRUTEUR',
 'body'=> 'Votre compte recruteur a ete enregistrer avec succes
 Merci de votre confiance a notre platforme '
            ];
            Mail::to($user->email)->send(new SendMail($data));
        } catch (\Throwable $e) {
            DB::rollback();
            Storage::delete('/storage/images/'.$imageName);
            Storage::delete('/storage/pdfs/'.$pdfName);
            return response()->json([
                'message' => 'An error occurred while registering the company',
                'error' => $e->getMessage()
            ], 500);
        }

        if ($token = auth('api')->attempt(['email'=> $request->email_recruteur, 'password'=>$request->password_recruteur])){
            return response()->json([
                'message' => 'recruteur registered successfully',
                'token' => $token,
                'recruteur' => $user
            ]);
        }else{
            return response()->json([
                'message' => 'An error occurred while authenticating the recruteur'
            ], 401);
        }
    }
}
