<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\QualificationDetail;
use App\Models\ExperienceDetail;
use App\Models\documents;

use Illuminate\Support\Facades\Auth;

class ReUploadController extends Controller
{
        public function reUpCPhoto(Request $request){

            $request->validate([
                'candidatePhoto'=>'required|image|mimes:jpeg,png,jpg|max:1024',
             ]);

             if($request->hasFile('candidatePhoto')) {
                 $img_ext = $request->file('candidatePhoto')->getClientOriginalExtension();
                 $filename = 'candidatePhoto-' . time() . '.' . $img_ext;
                 $path = $request->file('candidatePhoto')->move(public_path('uploads'), $filename);//image save public folder
               }
         $user = documents::create([
             'user_id'=>Auth::user()->id,
             'doc_title'=>'Candidate Photo',
             'document'=>$filename,
             'reUploadStatus'=>1
         ]);


            // $reChange=User::where('id','=',Auth::user()->id)->first();
            // if($reChange->certificateVerificationStatus != 5){
            //         $reChange->certificateVerificationStatus=7;
            //         $reChange->save();
            // }

        }



        public function reUpAadharB(Request $request){

            $request->validate([
               'aadharBack'=>'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);

            if($request->hasFile('aadharBack')) {
                $img_ext = $request->file('aadharBack')->getClientOriginalExtension();
                $filename = 'aadharBack-' . time() . '.' . $img_ext;
                $path = $request->file('aadharBack')->move(public_path('uploads'), $filename);//image save public folder
              }
        $user = documents::create([
            'user_id'=>Auth::user()->id,
            'doc_title'=>'Aadhar Back Side',
            'document'=>$filename,
            'reUploadStatus'=>1
        ]);

    }


    public function reUpAadharF(Request $request){

        $request->validate([
            'aadharFront'=>'required|image|mimes:jpeg,png,jpg|max:1024',
         ]);

         $check=documents::where([['doc_title','=',$request->docName],['user_id','=',Auth::user()->id],['reUploadStatus','=',1]])->first();
         if($check){

            return 'already Uploaded';
            }

         if($request->hasFile('aadharFront')) {
             $img_ext = $request->file('aadharFront')->getClientOriginalExtension();
             $filename = 'aadharFront-' . time() . '.' . $img_ext;
             $path = $request->file('aadharFront')->move(public_path('uploads'), $filename);//image save public folder
           }
     $user = documents::create([
         'user_id'=>Auth::user()->id,
         'doc_title'=>'Aadhar Front Side',
         'document'=>$filename,
         'reUploadStatus'=>1


     ]);

}



public function PostDocReUp(Request $request){

    $request->validate([
    'certificate'=>'required|image|mimes:jpeg,png,jpg|max:1024',
    ]);


    $check=documents::where([['doc_title','=',$request->docName],['user_id','=',Auth::user()->id],['reUploadStatus','=',1]])->first();

    if($check){

    return 'already Uploaded';
    }

    if($request->hasFile('certificate')) {
    $img_ext = $request->file('certificate')->getClientOriginalExtension();
    $filename = Auth::user()->name.' - '.$request->docName.'- certificate -' . time() . '.' . $img_ext;
    $path = $request->file('certificate')->move(public_path('uploads'), $filename);//image save public folder
    }
    $user = documents::create([
    'user_id'=>$request->userId,
    'doc_title'=>$request->docName,
    'document'=>$filename,
    'reUploadStatus'=>1
    ]);

    if( $user){

    return 'success';
    }




    }
}
