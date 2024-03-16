<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AccountController extends Controller
{
    public function accounts(){
        $accounts = User::where('usertype', 'doctor')
                ->orWhere('usertype', 'staff')
                ->get();
        return view('admin.accounts', ['accounts' => $accounts]);
        
    }
}
