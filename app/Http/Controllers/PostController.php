<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post as ModelsPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function add_post(Request $request){
        $request->validate([
            'title'=>['required','string'],
            'content'=>['required','string'],
            'image'=>['required','mimes:jpeg,png,jpg', 'max:2048']
        ]);
        $post= new ModelsPost();
        $post->title = $request->title;
        $post->content = $request->content;
        $titre = Str::slug($post->title, '-');
            $slug = $post->post_id. '-' . $titre;
            $post->slug = $slug;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->put('posts/' . $imageName, file_get_contents($image));
            $post->image =  $imageName;
        }
   
       
 
        try {
            DB::beginTransaction();
            $post->save();
            DB::commit();
            if($post->save()){
                return response()->json([
                    'message' => 'post ajouté',  
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollback();
            Storage::delete('/storage/posts/'.$imageName);
          
            return response()->json([
                'message' => 'An error occurred while insert the post',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
public function getallposts(Request $request)
{
  
    $allposts = ModelsPost::withTrashed()->orderBy('created_at', 'desc')->get();
    foreach ( $allposts  as $post) {
        $limitedDescription = Str::limit($post->content,10);
        $post->content = $limitedDescription;
    }
    return response()->json([
        'allposts' => $allposts, 
        ]);
}
public function deletepost($id)
{
    $post = ModelsPost::find($id);
    if(!$post) {
        // Offer not found
        return response()->json(['error' => 'post not found'], 404);
    }
    $post->delete();
    // Return a success response
    return response()->json(['message' => 'post deleted successfully']);
}
public function getpost($id)
{
    $post = ModelsPost::withTrashed()->find($id);
    if(!$post) {
        return response()->json(['error' => 'post not found'], 404);
    }else{
        return response()->json([
            'post' => $post
    ]);
    }
}
public function updatepost($id, Request $request)
{ 
        $post = ModelsPost::withTrashed()->findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        
        if ($request->hasFile('image')) {
            
            if(Storage::disk('public')->exists('posts/'.$post->image)) {
                Storage::disk('public')->delete('posts/'.$post->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->put('posts/'.$imageName, file_get_contents($image));
            $post->image= $imageName;
            $post->update();
        }else{
            return response()->json(['vvv' => 'vv']);
        }
        try{
            DB::beginTransaction();
            $post->update();
            DB::commit();
            return response()->json(['message_succes' => 'post updated successfully']);
        }catch(\Throwable $e){
            DB::rollback();
            return response()->json([
                'message' => '',
                'error' => $e->getMessage()
            ],500);
        }
}
public function restorepost($id)
    {
       
        $post = ModelsPost::onlyTrashed()->find($id);

        if (!$post) {
            return response()->json(['error' => 'post not found'], 404);
        }
        $post->restore();
        
        // Return a success response
        return response()->json(['message' => 'post restored successfully']);
    }
    public function getpostsTrashed()
    {
       
        $allpoststrashed = ModelsPost::onlyTrashed()->get();
        foreach ($allpoststrashed  as $post) {
            $limitedDescription = Str::limit($post->content,10);
            $post->content = $limitedDescription;
        }
        return response()->json(['allpoststrashed' => $allpoststrashed]);
    }
}
