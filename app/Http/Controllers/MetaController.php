<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meta;
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

//     //         // $title = $request->get('title');
//     //         $file = $request->file('filenames');

//     //         $file_name = rand().".".$file->getClientOriginalExtension();
//     //         $file_name3 = rand().".".$file->getClientOriginalExtension();
//     //         $file_name7 = rand().".".$file->getClientOriginalExtension();
//     //         $file_name10 = rand().".".$file->getClientOriginalExtension();
            
//     //         //Move Uploaded File
//     //         $destinationPath = 'uploads';
//     //         $file->move($destinationPath, $file_name);

            
//     //         $video = new Meta([
//     //             // 'title' => $request->get('title'),
//     //             'filenames' => $file_name3
//     //         ]);

//     //         $video->save();

//     //         return response()->json($video);
      
//     // }
//     }
// }

{
    // show form
    public function index() {
        return view('upload');
    }

    // file upload
    public function upload(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'files' => 'required'
        ])->validate();

        if($validator){

            $total_files = count($request->file('files'));
            $cart = [];

            foreach ($request->file('files') as $file) {
                // rename & upload files to uploads folder
                $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/uploads';
                $file->move($path, $name);
    
                // store in db
                $fileUpload = new Meta();
                $fileUpload->filenames = $path.$name;
                $fileUpload->save();

                array_push($cart,$fileUpload);

            }
            // $cart = array_count_values($file);
            
            if($fileUpload->save()){
                return response()->json(["data"=>$cart]);

                // dd($file->toArray());
            }
        }else{
            return response()->json(["error"=>$validator]);
        }

    }
}