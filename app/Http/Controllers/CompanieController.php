<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\company as ModelsCompany;
class CompanieController extends Controller
{
    public function getallcompanies()
    {
        $allcompanies = ModelsCompany::with('recruteur')->get();
        return response()->json([
            'allcompanies' => $allcompanies, 
        ]);
    }

    public function valider_companie($id)
    {
        $company = ModelsCompany::with('recruteur')->find($id);
        $company->status = 'verified';
        $company->update();
        $data = [
            'name' => $company->recruteur->name,
            'type' => 'company verification',
            'subject' => 'Vérification de compte réussie',
        ];
        Mail::to($company->recruteur->email)->send(new SendMail($data));
        return response()->json([
            'message' => 'societe verified', 
        ]);
        
    }
}
