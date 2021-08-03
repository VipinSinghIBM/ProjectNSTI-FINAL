<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\QualificationDetail;
use App\Models\ExperienceDetail;
use App\Models\documents;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ApplicationFormPdfController extends Controller
{
    public function getDataPdf(){

dd('here reached');
        // $userAllDataForPdf=User::where('id','=',$request->id)->get();
        // return $userAllDataForPdf;

    }
}
