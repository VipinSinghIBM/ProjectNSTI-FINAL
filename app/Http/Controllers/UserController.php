<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

        public function index(){
            $chgangStatus=User::where('id','=',Auth::user()->id)->first();
            if($chgangStatus->formNextStatus == null){
                $chgangStatus->formNextStatus=1;
                    $chgangStatus->save();
            }
            return view('dashboards.users.index');

        }

        public function profile(){
            return view('dashboards.users.profile');

        }

        public function settings(){
            return view('dashboards.users.settings');

        }

        // public function reuploadDocs(){
        //     return view('dashboards.users.reuploadDocs');
        // }





}
