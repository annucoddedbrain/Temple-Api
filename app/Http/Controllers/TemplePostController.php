<?php

namespace App\Http\Controllers;

use App\Models\TemplePost;
use Illuminate\Http\Request;
use App\Models\User;
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
            'media' => 'required|string',
            'location' => 'required|string',
            'location_LatLng' => 'string|nullable',
            'time_table' => 'string|nullable',
           
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
                    'media' => $request->media,
                    'location' => $request->location,
                    'location_LatLng' => $request->location_LatLng,
                    'time_table' => $request->time_table,
                    'user_id' => $user->id,
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
}
