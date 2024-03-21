<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function user_info() {
        return view('user.user_info');
    }
}
