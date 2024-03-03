<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(auth::id())
        {
            $usertype=Auth()->user()->usertype;

            if($usertype=='user')
            {
                return view('welcome');
            }
            else if($usertype=='admin')
            {
                return view('admin.patient-record');
            }
            else if($usertype=='doctor')
            {
                return view('admin.patient-record');
            }
            else if($usertype=='staff')
            {
                return view('admin.patient-record');
            }
            else
            {
                return redirect()->back();
            }
        }
    }
}
