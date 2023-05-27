<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
