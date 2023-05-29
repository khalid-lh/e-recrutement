<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User as ModelsUser;
use App\Models\Profil as ModelsProfil;
use App\Models\company as ModelsCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class UserController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register_condidat','register_recruteur','deconnexion']]);
    }

    public function index()
    {
        return view('recruteurdashboard');
    }
   
    public function deconnexion()
{
     Auth::logout(); 

    return view('recruteurdashboard');
}
public function login(Request $request)
{
    $request->validate([
        'email' => ['required'],
        'password' => ['required']
    ], [
        'password.required' => 'Mot de pass obligatoire.',
        'email.required' => 'Email obligatoire.'
    ]);
   

    $credentials = $request->only('email', 'password');

    if ($token = auth('api')->attempt($credentials)) {
        $user = auth('api')->user();
        return response()->json([
            'message' => 'Authentication successful',
            'token' => $token,
            'user' => $user
        ]);
        
    } else {
        // Invalid email or password
        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
    }
}


    public function register_condidat(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:10'],
            'email' => ['required', 'string', 'unique:users', 'email', 'regex:/^(?=.*[a-z])(?=.*[A-Z])/i'],
            'password' => ['required', 'string', 'min:8', 'max:12'],
            'telephone' => ['required', 'numeric'],
            'ville' => ['required', 'string'],
            'pays' => ['required', 'string'],
            'cv' => ['required', 'mimes:pdf', 'max:2048'],
            'image' => ['required', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'name.required' => 'Le champ nom est requis.',
            'name.string' => 'Le champ nom doit être une chaîne de caractères.',
            'name.min' => 'Le nom doit comporter au moins :min caractères.',
            'name.max' => 'Le nom ne doit pas dépasser :max caractères.',
            'email.required' => 'Le champ email est requis.',
            'email.string' => 'Le champ email doit être une chaîne de caractères.',
            'email.unique' => 'L\'adresse email est déjà utilisée.',
            'email.email' => 'L\'adresse email doit être valide.',
            'password.required' => 'Le champ mot de passe est requis.',
            'password.string' => 'Le champ mot de passe doit être une chaîne de caractères.',
            'password.regex' => 'Le mot de passe doit contenir des lettres majuscules et minuscules.',
            'password.min' => 'Le mot de passe doit comporter au moins :min caractères.',
            'password.max' => 'Le mot de passe ne doit pas dépasser :max caractères.',
            'telephone.required' => 'Le champ téléphone est requis.',
            'telephone.numeric' => 'Le champ téléphone doit contenir uniquement des chiffres.',
            'ville.required' => 'Le champ ville est requis.',
            'ville.string' => 'Le champ ville doit être une chaîne de caractères.',
            'pays.required' => 'Le champ pays est requis.',
            'pays.string' => 'Le champ pays doit être une chaîne de caractères.',
            'cv.required' => 'Le champ CV est requis.',
            'cv.mimes' => 'Le CV doit être un fichier de type : pdf.',
            'cv.max' => 'Le CV ne doit pas dépasser :max kilo-octets.',
            'image.required' => 'Le champ image est requis.',
            'image.mimes' => 'L\'image doit être un fichier de type : jpeg, png, jpg.',
            'image.max' => 'L\'image ne doit pas dépasser :max kilo-octets.',
        ]);
        
        try {
            DB::beginTransaction();
    
            $user = new ModelsUser();
            $user->name = $request->name;
            $user->user_type = 'condidat';
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
    
            $profil = new ModelsProfil();
            $profil->user_id = $user->id;
            $profil->telephone = $request->telephone;
            $profil->ville = $request->ville;
            $profil->pays = $request->pays;
    
            if ($request->hasFile('image')) {
                // Upload and save image file
                // Handle errors if any
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
                $profil->photo =  $imageName;
            }
    
            if ($request->hasFile('cv')) {
                // Upload and save CV file
                // Handle errors if any
                $pdf = $request->file('cv');
                $pdfName = time() . '_' . $pdf->getClientOriginalName();
                Storage::disk('public')->put('pdfs/' . $pdfName, file_get_contents($pdf));
                $profil->cv = $pdfName;
            }
    
            $profil->save();
    
            DB::commit();
    
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
    
            // Delete uploaded files in case of error
            if (isset($imageName)) {
                Storage::delete('public/images/' . $imageName);
            }
            if (isset($pdfName)) {
                Storage::delete('public/pdfs/' . $pdfName);
            }
    
            return response()->json([
                'message' => 'An error occurred while registering the user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function register_recruteur(Request $request)
{   
    $imageName = '';
    $pdfName = '';
    $request->validate([
        'name_recruteur' => ['required', 'string', 'min:5', 'max:10'],
        'email' => ['required', 'string', 'email','unique:users', 'min:12', 'max:30'],
        'password_recruteur' => [
            'required',
            'string',
            'min:8',
            'max:20',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])/i',
        ],
        'company_name' => ['required', 'string','unique:companies'],
        'telephone_societe' => ['required', 'numeric'],
        'ville_societe' => ['required', 'string'],
        'pays_societe' => ['required', 'string'],
        'description' => ['required', 'string'],
        'code_postal' => ['required', 'numeric'],
        'register_commerce' => ['required', 'mimes:pdf', 'max:2048'],
        'logo' => ['required', 'mimes:jpeg,png,jpg']
    ], [
        'name_recruteur.required' => 'Le nom est obligatoire',
        'name_recruteur.min' => 'Le nom du recruteur doit comporter au moins 5 caractères.',
        'name_recruteur.max' => 'Le nom du recruteur ne doit pas dépasser 10 caractères.',
        'email.required' => 'email est obligatoire',
        'email.email' => 'email Invalid',
        'email.unique' => 'L\'adresse email est déjà utilisée.',
        'password_recruteur.required' => 'Mot de Pass est obligatoire',
        'password_recruteur.min' => 'Le mot de passe recruteur doit comporter au moins 8 caractères.',
        'password_recruteur.max' => 'Le mot de passe recruteur ne doit pas dépasser 20 caractères.',
        'password_recruteur.regex' => 'Le mot de passe doit contenir des lettres majuscules et minuscules.',
        'company_name.required' => 'Nom Societe est obligatoire',
        'company_name.unique' => 'le Nom de la societe est déjà utilisée.',
        'telephone_societe.required' => 'Telephone est obligatoire',
        'telephone_societe.numeric' => 'Le champ téléphone ne doit contenir que des numéros.',
        'ville_societe.required' => 'Ville est obligatoire',
        'pays_societe.required' => 'Pay est obligatoire.',
        'description.required' => ' Description est obligatoire.',
        'code_postal.required' => 'code postal est obligatoire.',
        'code_postal.numeric' => 'code_postal ne doit contenir que des numéros.',
        'register_commerce.required' => 'Register de Commerce est obligatoire.',
        'register_commerce.mimes' => 'Register de Commerce doit être un fichier PDF.',
        'register_commerce.max' => 'Register de Commerce ne doit pas dépasser 2048 kilo-octets.',
        'logo.required' => 'Logo est obligatoire.',
        'logo.mimes' => 'Logo doit être un fichier image JPEG, PNG ou JPG.',
    ]);
    
    try {
        DB::beginTransaction();

        $user = new ModelsUser();
        $user->name = $request->name_recruteur;
        $user->user_type = 'recruteur';
        $user->email = $request->email;
        $user->password = bcrypt($request->password_recruteur);
        $user->save();

        $company = new ModelsCompany();
        $company->id_recruteur = $user->id;
        $company->company_name = $request->company_name;
        $company->telephone = $request->telephone_societe;
        $company->ville = $request->ville_societe;
        $company->pays = $request->pays_societe;
        $company->code_postal = $request->code_postal;
        $company->description = $request->description;
        if ($request->hasFile('logo')) {
            // Upload and save logo image file
            $image = $request->file('logo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
            $company->photo = $imageName;
        }

        if ($request->hasFile('register_commerce')) {
            // Upload and save register_commerce file
            $pdf = $request->file('register_commerce');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            Storage::disk('public')->put('pdfs/' . $pdfName, file_get_contents($pdf));
            $company->register_commerce = $pdfName;
        }
        $company->save();

        DB::commit();

        return response()->json([
            'message' => 'Recruteur registered successfully',
            'recruteur' => $user
        ]);
    } catch (\Illuminate\Database\QueryException $e) {
        DB::rollback();

        // Delete uploaded files in case of error
        if (isset($imageName)) {
            Storage::delete('public/images/' . $imageName);
        }
        if (isset($pdfName)) {
            Storage::delete('public/pdfs/' . $pdfName);
        }

        // Check if the error is due to duplicate company name
        if ($e->getCode() === '23000' && strpos($e->getMessage(), 'companies_company_name_unique') !== false) {
            return response()->json([
                'message' => 'company name already exists'
            ], 422);
        }

        return response()->json([
            'message' => 'An error occurred while registering the user or company',
            'error' => $e->getMessage()
        ], 500);
    } catch (\Throwable $e) {
        DB::rollback();

        // Delete uploaded files in case of error
        if (isset($imageName)) {
            Storage::delete('public/images/' . $imageName);
        }
        if (isset($pdfName)) {
            Storage::delete('public/pdfs/' . $pdfName);
        }

        return response()->json([
            'message' => 'An error occurred while registering the user or company',
            'error' => $e->getMessage()
        ], 500);
    }
    
}
public function getUserTypeFromDatabase()
{
    $user = Auth::user(); // Get the authenticated user
    
    if ($user) {
        $userType = $user->user_type; // Assuming the user type is stored in the "user_type" column
       
        if ($userType) {
            return response()->json([
                'userType' => $userType
            ]);
        } else {
            // Handle the case where the user type is not defined
        }
    } else {
        // Handle the case where the user is not authenticated
    }
}
}