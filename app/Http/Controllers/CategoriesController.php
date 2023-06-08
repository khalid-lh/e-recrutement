<?php

namespace App\Http\Controllers;
use App\Models\categories as ModelsCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class CategoriesController extends Controller
{
    public function add_categorie(Request $request){
        $request->validate([
            'name_categorie'=>['required','string'],
        ],[
            'name_categorie.required' => 'Le nom est obligatoire',
        ]);
        $categorie= new ModelsCategorie();
        $categorie->name_categorie = $request->name_categorie;
        try {
            DB::beginTransaction();
            $categorie->save();
            DB::commit();
            if($categorie->save()){
                return response()->json([
                    'message' => 'categorie ajouté',  
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollback();
        }
    }
    public function getallcategories(Request $request)
{
  
    $categories= ModelsCategorie::orderBy('created_at', 'desc')->get();
    
    return response()->json([
        'categories' => $categories, 
        ]);
}
}
