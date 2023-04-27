<?php

namespace App\Http\Controllers;

use App\Models\TemplePost;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Meta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TemplePostController extends Controller
{
    public function createPost(Request $request){
        // $user = User::all();
        $user = User::first();


        $validator = Validator::make($request->all(), [
            'title' => 'required|string',               
            'description' => 'required|string',
            'meta_id' => 'string',
            'location' => 'required|string',
            'location_LatLng' => 'string|nullable',
            'time_table' => 'string|nullable',
            'filenames' => 'required|string',     // media files
           
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->messages()
            ]);

        }
        else
        {
            if($validator)
            {
                $post = TemplePost::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'location' => $request->location,
                    'location_LatLng' => $request->location_LatLng,
                    'time_table' => $request->time_table,
                    'user_id' => $user->id,
                    'meta_id' => $user->id,
                ]);

                 if($post->save()){

                return response()->json([
                    "status" => true,
                    "message" => "User has been posted successfully.",
                    "data" => $post
                ]);
            } 
            else{
                return response()->json([
                    "message" => "error"
                ]);
            }

 
            }
        }
    }
    public function createMeta(Request $request){
        // $user = User::all();
        $user = User::first();
        $post = TemplePost::first();


        $validator = Validator::make($request->all(), [
            'filenames' => 'required|string',               
            'path' => 'required|string',
            'size' => 'required|string',
            'type' => 'required|string',
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->messages()
            ]);

        }
        else
        {
            if($validator)
            {
                $total_files = count($request->file('files'));
                $cart = [];
                foreach ($request->file('files') as $file) {
                    // rename & upload files to uploads folder
                    $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                    // $path = 'C:\Users\dev2c\OneDrive\Desktop\meta\uploads';  // physical address on PC level to   store data on deshtop 
                    $path = public_path() . '/uploads';    // physical address on project level to store data  
                    $file->move($path, $name);
        
                    // store in db
                    $fileUpload = new Meta();
                    $fileUpload->filenames = $path.$name;
                    $fileUpload->save();
    
                    array_push($cart,$fileUpload);
                }
                
                if($fileUpload->save() && $total_files==$cart){
                    return response()->json(["data"=>$cart]);
    
                    // dd($file->toArray());
                }

 
            }
        }
    }

    
    public function showDetail(Request $request){
        

        $post = TemplePost::with(['user',   
        ])->find(2);

        
        return response()->json([
            'data' => $post
        ]);
    }
}
