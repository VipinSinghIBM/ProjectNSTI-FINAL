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


class AdminDashboardCountController extends Controller
{
   public function totalCount(){

            $applications = User::all()->where('role', '=', 2);
            $allApplicationsCount=$applications->count();

            $applications = User::all()->where('role', '=', 2)->where('formNextStatus','=',5);
            $allApplicationFormCompletedCount=$applications->count();

            $male = User::all()->where('role', '=', 2)->where('gender', '=', 'Male');
            $allMaleCount=$male->count();

            $female = User::all()->where('role', '=', 2)->where('gender', '=', 'Female');
            $allFemaleCount=$female->count();

            $others = User::all()->where('role', '=', 2)->where('gender', '=', 'Others');
            $allOthersCount=$others->count();

            $certVerifyPending = User::all()->where('formNextStatus', '=', 5)->where('certificateVerificationStatus', '=', null);
            $allcertVerifyPendingCount=$certVerifyPending->count();

            $certVerified = User::all()->where('role', '=', 2)->where('certificateVerificationStatus', '=', '0');
            $allcertVerifiedCount=$certVerified->count();


            $certReUploaded = documents::all()->where('reUploadStatus', '=', '1')->unique('user_id');
            $allReUploadedCount=$certReUploaded->count();



            $feePending = User::all()->where('formNextStatus', '=', 5)->where('feeVerificationStatus', '=', null);
            $allFeePendingCount=$feePending->count();

            $feeVerified = User::all()->where('role', '=', 2)->where('feeVerificationStatus', '=', '1');
            $allFeeVerifiedCount=$feeVerified->count();

            $feeRejected = User::all()->where('role', '=', 2)->where('feeVerificationStatus', '=', '2');
            $allFeeRejectedCount=$feeRejected->count();

            $AdmissionPending = User::all()->where('feeVerificationStatus', '=', 1)->where('certificateVerificationStatus', '=', 0)->where('AdmissionStatus','=',null);
            $allAdmissionPendingCount=$AdmissionPending->count();

            $WaitingList = User::all()->where('role', '=', 2)->where('AdmissionStatus', '=', '3');
            $allWaitingListCount=$WaitingList->count();

            $RejectedStudents = User::all()->where('role', '=', 2)->where('AdmissionStatus', '=', '2');
            $allRejectedCount=$RejectedStudents->count();

            $AdmittedStudents = User::all()->where('role', '=', 2)->where('AdmissionStatus', '=', '1');
            $allAdmittedCount=$AdmittedStudents->count();


            return [

                'totalAppli'=>$allApplicationsCount,
                'totalAppliFormFilled'=>$allApplicationFormCompletedCount,
                'male'=>$allMaleCount,
                'female'=>$allFemaleCount,
                'others'=>$allOthersCount,
                'certVerifyPending'=>$allcertVerifyPendingCount,
                'reUploaded'=>$allReUploadedCount,
                'certVerified'=>$allcertVerifiedCount,
                'feeVerifyPending'=>$allFeePendingCount,
                'feeVerified'=>$allFeeVerifiedCount,
                'feeRejected'=>$allFeeRejectedCount,
                'admissionPending'=>$allAdmissionPendingCount,
                'waitingList'=>$allWaitingListCount,
                'rejected'=>$allRejectedCount,
                'admitted'=>$allAdmittedCount,

            ];


   }






}


