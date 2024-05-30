<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function accounts(){
        $accounts = User::where('usertype', 'doctor')
                ->orWhere('usertype', 'staff')
                ->get();
        return view('admin.accounts', ['accounts' => $accounts]);
        
    }

    public function search_account(Request $request){
        $search = $request->input('search');
        $accounts = User::where(function($query) use ($search) {
            $query->where('usertype', 'doctor')
                  ->orWhere('usertype', 'staff');
        })
        ->where('name', 'like', "%$search%")
        ->get();
        
        return view('admin.accounts', ['accounts' => $accounts]);
        
    }


    public function delete_account($account){
        DB::table('users')->where('id', '=', $account)->delete();
        return redirect(route('accounts'));
    }
}
