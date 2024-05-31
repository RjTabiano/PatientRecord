<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\ActivityLog\Models\Activity;


class DoctorController extends Controller
{
    public function doctors(){
        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.doctors', ['doctors' => $doctors]);
    }


    public function store_doctor(Request $request){
        $newDoctor = new Doctor();
        $newUser = new User();
        if (User::where('name', $request->input("name"))->exists()) {
            die("Error: 404");
        } else {
            
            $newUser->name = $request->input("name");
            $newUser->email = $request->input("email");
            $newUser->password = $request->input("password");
            $newDoctor->specialization = $request->input("specialization");
            $newUser->usertype = $request->input("usertype");
            $newUser->save();
            $newUser->doctor()->save($newDoctor);
        }
        activity()->log("Created doctor's account.");

        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.doctors', ['doctors' => $doctors]);
    }
    public function delete_doctor(User $doctor){
        $doctor->delete();
        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.doctors', ['doctors' => $doctors]);
    }
    
    public function update_doctor(User $doctor, Request $request){
        $doctor->name = $request->input("name");
        $doctor->email = $request->input("email");
        $doctor->password = $request->input("password");
        $doctor->update();
        $doctor->doctor()->update(['specialization' => $request->input("specialization")]);
        
        
        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.doctors', ['doctors' => $doctors]);
    }
    public function edit_doctor(User $doctor){
        return view('admin.edit_doctor', ['doctor' => $doctor]);
    }
}
