<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QualificationDetail;
use App\Models\ExperienceDetail;
use App\Models\documents;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Filesystem\FilesystemManager as Storage;

class ApplicationFormController extends Controller
{


    public function getFormStatus(){
        $getStatus=User::where('id','=',Auth::user()->id)->pluck('formNextStatus')->first();

                return $getStatus;
    }

    public function saveData(Request $request){



        $request->validate([//want to uncomment@18/16/2021 12:44am
            'tradeName'=>'required',
            'itiPassed'=>'required',
            'isDiplomaHolder'=>'required',
            'dob'=>'required',
            'fatherGuardianName'=>'required',
            'motherName'=>'required',
            'gender'=>'required',
            'category'=>'required',
            'physicallyHandicapped'=>'required',
            'traineeType'=>'required',
            // 'employeeCodePEN'=>'required',
            'aadharNumber'=>['required','digits:12'],
            'maritalStatus'=>'required',
            'address'=>'required',

        ]);

        $user = User::find(Auth::user()->id)->update([



            'tradeName'=>$request->tradeName,
            'itiPassed' => $request->itiPassed,
            'isDiplomaHolder'=>$request->isDiplomaHolder,
            'dob'=>$request->dob,
            'fatherGuardianName'=>$request->fatherGuardianName,
            'motherName'=>$request->motherName,
            'gender'=>$request->gender,
            'category'=>$request->category,
            'physicallyHandicapped'=>$request->physicallyHandicapped,
            'traineeType'=>$request->traineeType,
            'employeeCodePEN'=>$request->employeeCodePEN,
            'aadharNumber'=>$request->aadharNumber,
            'maritalStatus'=>$request->maritalStatus,
            'address'=>$request->address,



        ]);


        $formStatusChange=User::where('id','=',Auth::user()->id)->first();
        $formStatusChange->formNextStatus=2;
        $formStatusChange->save();


    }


        public function upCPhoto(Request $request){

                $request->validate([
                   'candidatePhoto'=>'required|image|mimes:jpeg,png,jpg|max:200',
                ]);

                $check=documents::where([['doc_title','Candidate Photo'],['user_id','=',Auth::user()->id]])->first();

                if($check){

                return 'already Uploaded';
                }

                if($request->hasFile('candidatePhoto')) {
                    $img_ext = $request->file('candidatePhoto')->getClientOriginalExtension();
                    $filename = 'candidatePhoto-' . time() . '.' . $img_ext;
                    $path = $request->file('candidatePhoto')->move(public_path('uploads'), $filename);//image save public folder
                  }
            $user = documents::create([
                'user_id'=>Auth::user()->id,
                'doc_title'=>'Candidate Photo',
                'document'=>$filename,

            ]);

if($user){
return 'success';
}



        }

        public function upAadharF(Request $request){

            $request->validate([
               'aadharFront'=>'required|image|mimes:jpeg,png,jpg|max:200',
            ]);

            $check=documents::where([['doc_title','Aadhar Front Side'],['user_id','=',Auth::user()->id]])->first();

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


        //    $uploaded='document'=>$request->file('aadharFront')->move(public_path('uploads'),Str::uuid().'_'.$request->file('aadharFront')->getClientOriginalExtension()),
        ]);

if($user){
return 'success';
}

    }


    public function upAadharB(Request $request){

        $request->validate([
           'aadharBack'=>'required|image|mimes:jpeg,png,jpg|max:200',
        ]);

        $check=documents::where([['doc_title','Aadhar Back Side'],['user_id','=',Auth::user()->id]])->first();

        if($check){

        return 'already Uploaded';
        }

        if($request->hasFile('aadharBack')) {
            $img_ext = $request->file('aadharBack')->getClientOriginalExtension();
            $filename = 'aadharBack-' . time() . '.' . $img_ext;
            $path = $request->file('aadharBack')->move(public_path('uploads'), $filename);//image save public folder
          }
    $user = documents::create([
        'user_id'=>Auth::user()->id,
        'doc_title'=>'Aadhar Back Side',
        'document'=>$filename,
    ]);

if($user){
return 'success';
}

}




        public function postEducations(Request $request){

                foreach ($request->educations as $edu){



                    $user =QualificationDetail::create([
                      'user_id'=>Auth::user()->id,
                        'nameOfExamination'=>$edu['nameOfExamination'],
                        'nameOfUniversityOrBoard'=>$edu['nameOfUniversity'],
                        'tradeOrSubject'=>$edu['subject'],
                        'yearOfPassing'=>$edu['yearOfPass'],
                        'certificateNumber'=>$edu['certificateNo'],
                        'duration'=>$edu['duration'],
                        'percentageOfMarks'=>$edu['percentageOfMarks'],
                        'technicalOrAcademic'=>$edu['technicalOrAcademic'],
                    ]);

                }
                $formStatusChange=User::where('id','=',Auth::user()->id)->first();
                $formStatusChange->formNextStatus=3;
                $formStatusChange->save();

        }





                public function postExperience(Request $request){

                    foreach ($request->experiences as $exp){

                        $user =ExperienceDetail::create([
                            'user_id'=>Auth::user()->id,
                            'nameOfEmployer'=>$exp['nameOfEmployer'],
                            'natureOfJob'=>$exp['natureOfJob'],
                            'fromDate'=>$exp['fromDate'],
                            'toDate'=>$exp['toDate'],
                            'designation'=>$exp['designation'],
                            'currentEmployerStatus'=>$exp['currentEmployerStatus'],

                        ]);

                    }
                    $formStatusChange=User::where('id','=',Auth::user()->id)->first();
                    $formStatusChange->formNextStatus=4;
                    $formStatusChange->save();

                }


            public function GetExaminationNames(){
                if(Auth::check()){
                    $authId=Auth::user()->id;
                    $ExamFullData=QualificationDetail::where('user_id','=',$authId)->get();
                    return $ExamFullData;
                }

            }


//commented-05-08-2021

        //     public function upCertDocPhoto(Request $request){


        //         // $request->validate([
        //         //    'examCertDoc'=>'required|image|mimes:jpeg,png,jpg|max:1024',
        //         // ]);

        //         if($request->hasFile('examCertDoc')) {
        //             $img_ext = $request->file('examCertDoc')->getClientOriginalExtension();
        //             $filename = 'examCertDoc-' . time() . '.' . $img_ext;
        //             $path = $request->file('examCertDoc')->move(public_path('uploads'), $filename);//image save public folder
        //           }
        //             $user = documents::create([
        //                 'user_id'=>Auth::user()->id,
        //                 'doc_title'=>'examCertDocTest',
        //                 'document'=>$filename,
        //             ]);

        // }




            //filedynamicupload
            public function getDoc(){

                return QualificationDetail::where('user_id','=',Auth::user()->id)->get();

            }

            public function getDocReUpload(){

                return QualificationDetail::where('user_id','=',Auth::user()->id)->get();

            }


            public function postDoc(Request $request){

            $request->validate([
            'certificate'=>'required|image|mimes:jpeg,png,jpg|max:200',
            ]);


            $check=documents::where([['doc_title','=',$request->docName],['user_id','=',Auth::user()->id]])->first();

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
            ]);

            if( $user){

            return 'success';
            }




            }

        public function changeStatusFinalSubmit(Request $request){

            $formStatusChange=User::where('id','=',Auth::user()->id)->first();
            $formStatusChange->formNextStatus=5;
            $formStatusChange->save();

        }

        public function checkValuesFinalSubmit(){
            $check=documents::where('user_id','=',Auth::user()->id)->whereIn('doc_title',['Aadhar Back Side','Aadhar Front Side','Candidate Photo'])->first();

            if($check){

            return 'ok';
            }




        }

        public function reUpRemarksChangeBack(){
            $formStatusChange=User::where('id','=',Auth::user()->id)->first();
            $formStatusChange->certRemarks=null;
            $formStatusChange->save();

            //certificate verification status change after re-upload-documents
            $certStatusChange=User::where('id','=',Auth::user()->id)->first();
            $certStatusChange->certificateVerificationStatus=2;
            $certStatusChange->save();
        }


}
