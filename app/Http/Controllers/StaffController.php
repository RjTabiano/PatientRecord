<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\User;
use Spatie\ActivityLog\Models\Activity;

class StaffController extends Controller
{
    public function staffs(){
        
        $staffs = User::with('staff')->where('usertype', '=', 'staff')->get();
        return view('admin.staffs', ['staffs' => $staffs]);
    }

    public function store_staff(Request $request){
        $newStaff = new Staff();
        $newUser = new User();
        if (User::where('name', $request->input("name"))->exists()) {
            die("Error: User Already Exist");
        } else {
            
            $newUser->name = $request->input("name");
            $newUser->email = $request->input("email");
            $newUser->password = $request->input("password");
            $newStaff->role = $request->input("role");
            $newUser->usertype = $request->input("usertype");
            $newStaff->user_id = $newUser->id;
            $newUser->save();
            $newUser->staff()->save($newStaff);
        }
        activity()->log("{$newUser->name} staff account created.");

        $staffs = User::with('staff')->where('usertype', '=', 'staff')->get();
        return view('admin.staffs', ['staffs' => $staffs]);
    }

    public function delete_staff(User $staff){
        $staff->delete();
        $staffs = User::with('staff')->where('usertype', '=', 'staff')->get();
        return view('admin.staffs', ['staffs' => $staffs]);
    }

    public function update_staff(User $staff, Request $request){
        $staff->name = $request->input("name");
        $staff->email = $request->input("email");
        $staff->password = $request->input("password");
        $staff->update();
        $staff->staff()->update(['role' => $request->input("role")]);
        
        
        $staffs = User::with('staff')->where('usertype', '=', 'staff')->get();
        return view('admin.staffs', ['staffs' => $staffs]);
    }
    public function edit_staff(User $staff){
        return view('admin.edit_staff', ['staff' => $staff]);
    }
}
