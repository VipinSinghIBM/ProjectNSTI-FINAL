<?php

namespace App\Http\Controllers;

use App\Models\AdmittedStudentsDetail;
use App\Models\AdmittedStudentsEducation;
use App\Models\AdmittedStudentsExperience;
use App\Models\User;
use App\Models\QualificationDetail;
use App\Models\ExperienceDetail;
use App\Models\documents;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class AdminDataTablesController extends Controller
{

        public function showData(Request $request){


            $usersAllData=User::with('qualification')->where('role','=','2');
            // ->orderBy('certificateVerificationStatus','ASC')

            if ($request->trade_name)
            $usersAllData->where('tradeName', '=', $request->trade_name);

            if ($request->filter_gender)
            $usersAllData->where('gender', '=', $request->filter_gender);

            if ($request->filter_category)
            $usersAllData->where('category', '=', $request->filter_category);

            if ($request->date_from)
            $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

            if ($request->date_to)
            $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

            if($request->filter_examination_name){

                $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
                $myArray=[];
                    foreach($usersAllData1 as $a){

                        $z=$a['user_id'];

                        array_push($myArray,$z);

                        }
                    $usersAllData->whereIn('id',$myArray);


            }

            if($request->filter_mark_percentage){

                $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
                $myArrayPercentage=[];
                    foreach($usersAllData1 as $a1){

                        $z1=$a1['user_id'];

                        array_push($myArrayPercentage,$z1);

                        }
                    $usersAllData->whereIn('id',$myArrayPercentage);


            }




            return $usersAllData->paginate(7);




        }


        public function showDataForExcelExport(Request $request){


            $usersAllDataExport=User::where('role', '=', 2);
            // $usersAllDataExport->created_at=date('Y-m-d');

            if ($request->trade_name)
            $usersAllDataExport->where('tradeName', '=', $request->trade_name);

            if ($request->filter_gender)
            $usersAllDataExport->where('gender', '=', $request->filter_gender);

            if ($request->filter_category)
            $usersAllDataExport->where('category', '=', $request->filter_category);

            if ($request->date_from)
            $usersAllDataExport->whereDate('created_at' , '>=' , $request->date_from);

            if ($request->date_to)
            $usersAllDataExport->whereDate('created_at' , '<=' , $request->date_to);

            if($request->filter_examination_name){

                $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
                $myArray=[];
                    foreach($usersAllData1 as $a){

                        $z=$a['user_id'];

                        array_push($myArray,$z);

                        }
                    $usersAllDataExport->whereIn('id',$myArray);


            }

            if($request->filter_mark_percentage){

                $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
                $myArrayPercentage=[];
                    foreach($usersAllData1 as $a1){

                        $z1=$a1['user_id'];

                        array_push($myArrayPercentage,$z1);

                        }
                    $usersAllDataExport->whereIn('id',$myArrayPercentage);


            }

            return $usersAllDataExport->get();






        }


        public function docsGet(Request $request){

            $userAllDocs=documents::all()->where('user_id','=',$request->id);
            return $userAllDocs;

        }



        public function educationGet(Request $request){

            $userAllEducation=QualificationDetail::all()->where('user_id','=',$request->id);
            return $userAllEducation;

        }

        public function experienceGet(Request $request){

            $userAllExperience=ExperienceDetail::all()->where('user_id','=',$request->id);
            return $userAllExperience;

        }




        public function certVerify(Request $request){
            $user_data=User::find($request->id);
            if($user_data){
                $user_data->certificateVerificationStatus=0;
                $user_data->save();
                return "success";
            }
        }


        public function certReject(Request $request){

  //documents table
 $user_doc_data_first=documents::where('user_id','=',$request->id)->get();


                foreach($user_doc_data_first as $docFirst){

                if($docFirst['reUploadStatus']==null && $docFirst['docRejectionStatus']== null){
                        $docFirst['docRejectionStatus']=1;
                        $docFirst['docRejectionRemarks']=$request->Remarks;
                        $docFirst->save();
                }

                if($docFirst['reUploadStatus']==1 && $docFirst['docRejectionStatus']== !2){
                    $docFirst['docRejectionStatus']=2;
                    $docFirst['docRejectionRemarks']=$request->Remarks;
                    $docFirst->save();

                }



                }


// //documents table
// $user_doc_data_first=documents::where([['user_id','=',$request->id],['reUploadStatus','=',null]] )->update([
//     'docRejectionStatus'=>1,
//    'docRejectionRemarks'=>$request->Remarks,
//   ]);






                //documents table
            //     $user_doc_data=documents::where('user_id','=',$request->id)->update([
            //         'docRejectionStatus'=>1,
            //         'docRejectionRemarks'=>$request->Remarks,
            // ]);

            $user_data=User::find($request->id);
            if($user_data){

                if($user_data->certificateVerificationStatus>=2){
                                    return 'alredayRejected';
                                }

                if($user_data->certificateVerificationStatus < 2){
                    $user_data->certificateVerificationStatus++;
                        $user_data->certRemarks=$request->Remarks;
                        $user_data->save();
                        return "success";

                    }
              //     if($user_data->certificateVerificationStatus==2){
                //         return 'alredayRejected';
                //     }
                // $user_data->certificateVerificationStatus=1;
                // $user_data->certRemarks=$request->Remarks;
                // $user_data->save();
                // return "success";


            }



        }

        public function feeVerify(Request $request){
            $user_data=User::find($request->id);

            if($user_data){
                $user_data->feeVerificationStatus=1;
                $user_data->save();
                return "success";
            }
        }


        public function feeReject(Request $request){
            $user_data=User::find($request->id);
            if($user_data){
                $user_data->feeVerificationStatus=2;
                $user_data->save();
                return "success";
            }
        }


        public function TableDataForAdmission(Request $request){

            // $usersAllData=User::with('qualification')->where('certificateVerificationStatus', '=', 0)->where('feeVerificationStatus', '=', 1);
            $usersAllData=User::where('certificateVerificationStatus', '=', 0)->where('feeVerificationStatus', '=', 1);

            if ($request->trade_name)
            $usersAllData->where('tradeName', '=', $request->trade_name);

            if ($request->filter_gender)
            $usersAllData->where('gender', '=', $request->filter_gender);

            if ($request->filter_category)
            $usersAllData->where('category', '=', $request->filter_category);

            if ($request->date_from)
            $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

            if ($request->date_to)
            $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

            if($request->filter_examination_name){

                $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
                $myArray=[];
                    foreach($usersAllData1 as $a){

                        $z=$a['user_id'];

                        array_push($myArray,$z);

                        }
                    $usersAllData->whereIn('id',$myArray);


            }

            if($request->filter_mark_percentage){

                $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
                $myArrayPercentage=[];
                    foreach($usersAllData1 as $a1){

                        $z1=$a1['user_id'];

                        array_push($myArrayPercentage,$z1);

                        }
                    $usersAllData->whereIn('id',$myArrayPercentage);


            }




            return $usersAllData->paginate(7);





        }

        public function showDataForAdmissionExport(Request $request){

            // $usersAllData=User::with('qualification')->where('certificateVerificationStatus', '=', 0)->where('feeVerificationStatus', '=', 1);
            $usersAllData=User::where('certificateVerificationStatus', '=', 0)->where('feeVerificationStatus', '=', 1);

            if ($request->trade_name)
            $usersAllData->where('tradeName', '=', $request->trade_name);

            if ($request->filter_gender)
            $usersAllData->where('gender', '=', $request->filter_gender);

            if ($request->filter_category)
            $usersAllData->where('category', '=', $request->filter_category);

            if ($request->date_from)
            $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

            if ($request->date_to)
            $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

            if($request->filter_examination_name){

                $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
                $myArray=[];
                    foreach($usersAllData1 as $a){

                        $z=$a['user_id'];

                        array_push($myArray,$z);

                        }
                    $usersAllData->whereIn('id',$myArray);


            }

            if($request->filter_mark_percentage){

                $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
                $myArrayPercentage=[];
                    foreach($usersAllData1 as $a1){

                        $z1=$a1['user_id'];

                        array_push($myArrayPercentage,$z1);

                        }
                    $usersAllData->whereIn('id',$myArrayPercentage);


            }




            return $usersAllData->get();





        }


        //admit student
        public function admit(Request $request){
             $user_data=User::find($request->id);


            if($user_data){

                if($user_data->AdmissionStatus==1){
                    return 'alreadyAdmitted';
                }else{
                $user_data->AdmissionStatus=1;
                $user_data->save();
               $user_allData= User::where('id','=',$request->id)->get()->toArray();

                foreach ($user_allData as $userData){

                    $data=new AdmittedStudentsDetail;

                    $data->user_id=$userData['id'];
                    $data->username=$userData['username'];
                    $data->name=$userData['name'];
                    $data->email=$userData['email'];
                    $data->phonenumber=$userData['phonenumber'];
                    $data->tradeName=$userData['tradeName'];
                    $data->itiPassed=$userData['itiPassed'];
                    $data->isDiplomaHolder=$userData['isDiplomaHolder'];
                    $data->dob=$userData['dob'];
                    $data->fatherGuardianName=$userData['fatherGuardianName'];
                    $data->motherName=$userData['motherName'];
                    $data->gender=$userData['gender'];
                    $data->category=$userData['category'];
                    $data->physicallyHandicapped=$userData['physicallyHandicapped'];
                    $data->traineeType=$userData['traineeType'];
                    $data->employeeCodePEN=$userData['employeeCodePEN'];
                    $data->aadharNumber=$userData['aadharNumber'];
                    $data->maritalStatus=$userData['maritalStatus'];
                    $data->address=$userData['address'];

                    $data->save();

                }


                    //*******Admitted Students Education
                    $user_allDataEdu= QualificationDetail::where('user_id','=',$request->id)->get()->toArray();

                    foreach ($user_allDataEdu as $userDataEdu){

                        $dataEdu=new AdmittedStudentsEducation;

                        $dataEdu->user_id=$userDataEdu['user_id'];
                        $dataEdu->nameOfExamination=$userDataEdu['nameOfExamination'];
                        $dataEdu->nameOfUniversityOrBoard=$userDataEdu['nameOfUniversityOrBoard'];
                        $dataEdu->tradeOrSubject=$userDataEdu['tradeOrSubject'];
                        $dataEdu->yearOfPassing=$userDataEdu['yearOfPassing'];
                        $dataEdu->certificateNumber=$userDataEdu['certificateNumber'];
                        $dataEdu->duration=$userDataEdu['duration'];
                        $dataEdu->percentageOfMarks=$userDataEdu['percentageOfMarks'];
                        $dataEdu->technicalOrAcademic=$userDataEdu['technicalOrAcademic'];

                        $dataEdu->save();

                    }

                    //*******Admitted Students Experience
                    $user_allDataExp= ExperienceDetail::where('user_id','=',$request->id)->get()->toArray();

                    foreach ($user_allDataExp as $userDataExp){

                        $dataExp=new AdmittedStudentsExperience;

                        $dataExp->user_id=$userDataExp['user_id'];
                        $dataExp->nameOfEmployer=$userDataExp['nameOfEmployer'];
                        $dataExp->natureOfJob=$userDataExp['natureOfJob'];
                        $dataExp->fromDate=$userDataExp['fromDate'];
                        $dataExp->toDate=$userDataExp['toDate'];
                        $dataExp->designation=$userDataExp['designation'];
                        $dataExp->currentEmployerStatus=$userDataExp['currentEmployerStatus'];


                        $dataExp->save();

                    }

                }

            };

        }

            //reject student
            public function reject(Request $request){
                $user_data=User::find($request->id);


            if($user_data){

                if($user_data->AdmissionStatus==2){
                    return 'alreadyRejected';
                }else{
                    $user_data->AdmissionStatus=2;
                    $user_data->save();
                }

            };



            }

            //waiting List student
            public function waitingList(Request $request){
                $user_data=User::find($request->id);


            if($user_data){

                if($user_data->AdmissionStatus==3){
                    return 'alreadyWaited';
                }else{
                    $user_data->AdmissionStatus=3;
                    $user_data->save();
                }

            };

            }




        //ADMITTED LIST
        public function admittedList(Request $request){


            $usersAllData=User::where('AdmissionStatus', '=', 1);
            if ($request->trade_name)
            $usersAllData->where('tradeName', '=', $request->trade_name);

            if ($request->filter_gender)
            $usersAllData->where('gender', '=', $request->filter_gender);

            if ($request->filter_category)
            $usersAllData->where('category', '=', $request->filter_category);

            if ($request->date_from)
            $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

            if ($request->date_to)
            $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

            if($request->filter_examination_name){

                $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
                $myArray=[];
                    foreach($usersAllData1 as $a){

                        $z=$a['user_id'];

                        array_push($myArray,$z);

                        }
                    $usersAllData->whereIn('id',$myArray);


            }

            if($request->filter_mark_percentage){

                $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
                $myArrayPercentage=[];
                    foreach($usersAllData1 as $a1){

                        $z1=$a1['user_id'];

                        array_push($myArrayPercentage,$z1);

                        }
                    $usersAllData->whereIn('id',$myArrayPercentage);


            }



            return $usersAllData->paginate(7);


        }

        public function admittedStudentsExport(Request $request){


            $usersAllData=User::where('AdmissionStatus', '=', 1);
            if ($request->trade_name)
            $usersAllData->where('tradeName', '=', $request->trade_name);

            if ($request->filter_gender)
            $usersAllData->where('gender', '=', $request->filter_gender);

            if ($request->filter_category)
            $usersAllData->where('category', '=', $request->filter_category);

            if ($request->date_from)
            $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

            if ($request->date_to)
            $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

            if($request->filter_examination_name){

                $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
                $myArray=[];
                    foreach($usersAllData1 as $a){

                        $z=$a['user_id'];

                        array_push($myArray,$z);

                        }
                    $usersAllData->whereIn('id',$myArray);


            }

            if($request->filter_mark_percentage){

                $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
                $myArrayPercentage=[];
                    foreach($usersAllData1 as $a1){

                        $z1=$a1['user_id'];

                        array_push($myArrayPercentage,$z1);

                        }
                    $usersAllData->whereIn('id',$myArrayPercentage);


            }



            return $usersAllData->get();


        }

        //WAITING LIST
        public function waiting(Request $request){


            $usersAllData=User::where('AdmissionStatus', '=', 3);
            if ($request->trade_name)
            $usersAllData->where('tradeName', '=', $request->trade_name);

            if ($request->filter_gender)
            $usersAllData->where('gender', '=', $request->filter_gender);

            if ($request->filter_category)
            $usersAllData->where('category', '=', $request->filter_category);

            if ($request->date_from)
            $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

            if ($request->date_to)
            $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

            if($request->filter_examination_name){

                $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
                $myArray=[];
                    foreach($usersAllData1 as $a){

                        $z=$a['user_id'];

                        array_push($myArray,$z);

                        }
                    $usersAllData->whereIn('id',$myArray);


            }

            if($request->filter_mark_percentage){

                $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
                $myArrayPercentage=[];
                    foreach($usersAllData1 as $a1){

                        $z1=$a1['user_id'];

                        array_push($myArrayPercentage,$z1);

                        }
                    $usersAllData->whereIn('id',$myArrayPercentage);


            }



            return $usersAllData->paginate(7);

        }

   //WAITING LIST-export
   public function waitingListForExport(Request $request){


    $usersAllData=User::where('AdmissionStatus', '=', 3);
    if ($request->trade_name)
    $usersAllData->where('tradeName', '=', $request->trade_name);

    if ($request->filter_gender)
    $usersAllData->where('gender', '=', $request->filter_gender);

    if ($request->filter_category)
    $usersAllData->where('category', '=', $request->filter_category);

    if ($request->date_from)
    $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

    if ($request->date_to)
    $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

    if($request->filter_examination_name){

        $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
        $myArray=[];
            foreach($usersAllData1 as $a){

                $z=$a['user_id'];

                array_push($myArray,$z);

                }
            $usersAllData->whereIn('id',$myArray);


    }

    if($request->filter_mark_percentage){

        $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
        $myArrayPercentage=[];
            foreach($usersAllData1 as $a1){

                $z1=$a1['user_id'];

                array_push($myArrayPercentage,$z1);

                }
            $usersAllData->whereIn('id',$myArrayPercentage);


    }



    return $usersAllData->get();

}

        //Rejected LIST
        public function rejectListShow(Request $request){


            $usersAllData=User::where('AdmissionStatus', '=', 2);
            if ($request->trade_name)
            $usersAllData->where('tradeName', '=', $request->trade_name);

            if ($request->filter_gender)
            $usersAllData->where('gender', '=', $request->filter_gender);

            if ($request->filter_category)
            $usersAllData->where('category', '=', $request->filter_category);

            if ($request->date_from)
            $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

            if ($request->date_to)
            $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

            if($request->filter_examination_name){

                $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
                $myArray=[];
                    foreach($usersAllData1 as $a){

                        $z=$a['user_id'];

                        array_push($myArray,$z);

                        }
                    $usersAllData->whereIn('id',$myArray);


            }

            if($request->filter_mark_percentage){

                $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
                $myArrayPercentage=[];
                    foreach($usersAllData1 as $a1){

                        $z1=$a1['user_id'];

                        array_push($myArrayPercentage,$z1);

                        }
                    $usersAllData->whereIn('id',$myArrayPercentage);


            }



            return $usersAllData->paginate(7);

        }

//Rejected LIST-export
public function rejectedListForExport(Request $request){


    $usersAllData=User::where('AdmissionStatus', '=', 2);
    if ($request->trade_name)
    $usersAllData->where('tradeName', '=', $request->trade_name);

    if ($request->filter_gender)
    $usersAllData->where('gender', '=', $request->filter_gender);

    if ($request->filter_category)
    $usersAllData->where('category', '=', $request->filter_category);

    if ($request->date_from)
    $usersAllData->whereDate('created_at' , '>=' , $request->date_from);

    if ($request->date_to)
    $usersAllData->whereDate('created_at' , '<=' , $request->date_to);

    if($request->filter_examination_name){

        $usersAllData1=QualificationDetail::where('nameOfExamination','=',$request->filter_examination_name)->get();
        $myArray=[];
            foreach($usersAllData1 as $a){

                $z=$a['user_id'];

                array_push($myArray,$z);

                }
            $usersAllData->whereIn('id',$myArray);


    }

    if($request->filter_mark_percentage){

        $usersAllData1=QualificationDetail::where('percentageOfMarks','>=',$request->filter_mark_percentage)->get();
        $myArrayPercentage=[];
            foreach($usersAllData1 as $a1){

                $z1=$a1['user_id'];

                array_push($myArrayPercentage,$z1);

                }
            $usersAllData->whereIn('id',$myArrayPercentage);


    }



    return $usersAllData->get();

}

        //Admitted LIST-ADIT
        public function aditAdmittedList(){


            $usersAllData=User::where('AdmissionStatus', '=', 1)->where('tradeName','=','ADIT');

            return $usersAllData->paginate(7);




        }


        //Admitted LIST-R and AC
        public function RandAcAdmittedList(){


            $usersAllData=User::all()->where('AdmissionStatus', '=', 1)->where('tradeName','=','CITS-Mechanic RAC');
            return $usersAllData;

        }



        //Admitted LIST-R and AC
        public function ReadingOfDrawingAdmittedListShow(){


            $usersAllData=User::all()->where('AdmissionStatus', '=', 1)->where('tradeName','=','CITS-RODA');
            return $usersAllData;

        }


        //Admitted LIST-Electrician and wireman
        public function ElectricianWiremanAdmittedListShow(){


            $usersAllData=User::all()->where('AdmissionStatus', '=', 1)->where('tradeName','=','CITS-Electrician & Wireman');
            return $usersAllData;

        }

        //Admitted LIST-Electrician and wireman
        public function ElectronicMechanicAdmittedListShow(){


            $usersAllData=User::all()->where('AdmissionStatus', '=', 1)->where('tradeName','=','CITS-Electronic Mechanic');
            return $usersAllData;

        }

        //Admitted LIST-Electrician and wireman
        public function WelderAdmittedListShow(){


            $usersAllData=User::all()->where('AdmissionStatus', '=', 1)->where('tradeName','=','CITS-Welder');
            return $usersAllData;

        }

        //Admitted LIST-Solar Technician
        public function SolarTechnicianAdmittedList(){


            $usersAllData=User::all()->where('AdmissionStatus', '=', 1)->where('tradeName','=','CTS-Solar Technician');
            return $usersAllData;

        }

        //Admitted LIST-Solar Technician
        public function IotAdmittedListShow(){


            $usersAllData=User::all()->where('AdmissionStatus', '=', 1)->where('tradeName','=','CTS-IOT');
            return $usersAllData;

        }

        //Admitted LIST-Solar Technician
        public function ElectricianPowerDistributionListShow(){


            $usersAllData=User::all()->where('AdmissionStatus', '=', 1)->where('tradeName','=','CTS-Electrician Power Distribution');
            return $usersAllData;

        }




}
