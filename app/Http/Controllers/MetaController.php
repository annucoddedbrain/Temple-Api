<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meta;
use App\Models\TemplePost;
use App\Models\User;
// use App\Http\Controllers\Validator;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\VarDumper\Dumper\esc;

class MetaController extends Controller
// {
//     public function filesUpload(Request $request){
//         $destinationPath = 'D:\image';        
//         $path = $request->file('avatar')->store($destinationPath);        
//         $files = $request->allFiles('image');               
//         $count = 0;               
//         foreach ($files as $file) 
//         {
//             $file->store('public/uploads');
//             $count++;                //this technic also not work               
//             $name= $file->getClientOriginalName();                  
//             $file->move('public/uploads', $name);                  
//             $images[]=$name;          
//         }           //$count return only 1(it only upload one file)          
//      return response()->json($count, 201);
    


//     //     $rules = [
//     //         // 'filenames'=>'required|nullable',
//     //         'filenames.* '=>'required',
//     //         // 'video'=>'required|mimes:avi,mp4|max:200000'
//     //     ];

//     //     $response = array('response' => '', 'success'=> false);
        
//     //     $validator = Validator::make($request->all(), $rules);

//     //     //   $this->validate($request,$request->all(), $rules);


//     //     if ($validator->fails()) {
//     //         return response()->json( ['errors' => $validator->messages()]);
//     //     }else{

//     //         // $filenames = $request->get('filenames');
//     //         $file = $request->file('filenames');

//     //         $file_name = rand().".".$file->getClientOriginalExtension();
//     //         $file_name3 = rand().".".$file->getClientOriginalExtension();
//     //         $file_name7 = rand().".".$file->getClientOriginalExtension();
//     //         $file_name10 = rand().".".$file->getClientOriginalExtension();
            
//     //         //Move Uploaded File
//     //         $destinationPath = 'uploads';
//     //         $file->move($destinationPath, $file_name);

            
//     //         $video = new Meta([
//     //             // 'filenames' => $request->get('filenames'),
//     //             'filenames' => $file_name3
//     //         ]);

//     //         $video->save();

//     //         return response()->json($video);
      
//     // }
//     }
// }

// {
//     // show form
//     public function index() {
//         return view('upload');
//     }

//     // file upload
//     public function upload(Request $request)
//     {


//         $validator = Validator::make($request->all(), [
//             'files' => 'required|nullable',
//             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         ])->validate();
//         $extension = $request->file->extension();
//             return response()->json($extension);
//         if($validator){

//             $total_files = count($request->file('files'));
//             $cart = [];

//             foreach ($request->file('files') as $file) {
//                 // rename & upload files to uploads folder
//                 $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
//                 // $path = 'C:\Users\dev2c\OneDrive\Desktop\meta\uploads';  // physical address on PC level to   store data on deshtop 
//                 $path = public_path() . '/uploads';    // physical address on project level to store data  
//                 $file->move($path, $name);
    
//                 // store in db
//                 $fileUpload = new Meta();
//                 $fileUpload->filenames = $path.$name;
//                 $fileUpload->save();

//                 array_push($cart,$fileUpload);

//             }
//             // $cart = array_count_values($file);
            
//             if($fileUpload->save()){
//                 return response()->json(["data"=>$cart]);

//                 // dd($file->toArray());
//             }
//         }else{
//             return response()->json(["error"=>$validator]);
//         }

//     }
// }

{
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


                $post = Meta::create([
                    'filenames' => $request->filenames,
                    'path' => $request->path,
                    'size' => $request->size,
                    'type' => $request->type,
                    'user_id' => $user->id,
                    'temple_post_id' => $post->id,
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

    
    // public function showDetail(Request $request){
        

    //     $post = TemplePost::with(['user',   
    //     ])->find(2);

        
    //     return response()->json([
    //         'data' => $post
    //     ]);
    // }
}