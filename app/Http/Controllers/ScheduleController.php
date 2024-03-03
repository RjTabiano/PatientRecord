<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function schedules(){
        $userDoctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.schedules', ['userDoctors' => $userDoctors]);
    }

    public function store_schedule(Request $request){
        $newSchedule = new Schedule();
        $start_time = $request->input("start_time");
        $newSchedule->doctor_id = $request->input("doctor_id");
        $newSchedule->day = $request->input("day");
        $newSchedule->start_time = $start_time;
        $newSchedule->end_time= $request->input("end_time");
        $newSchedule->save();
        
        $userDoctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.schedules', ['userDoctors' => $userDoctors]);
    }

    public function delete_schedule(Schedule $schedule){
        $schedule->delete();
        $userDoctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.schedules', ['userDoctors' => $userDoctors]);
    }

    public function edit_schedule(Schedule $schedule){
        $userDoctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.edit_schedule', ['schedule' => $schedule], ['userDoctors' => $userDoctors]);
    }

    public function update_schedule(Schedule $schedule, Request $request){
        $schedule->doctor_id = $request->input("doctor_id");
        $schedule->day = $request->input("day");
        $schedule->start_time = $request->input("start_time");
        $schedule->end_time = $request->input("end_time");
        $schedule->update();
        
        
        
        $userDoctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.schedules', ['userDoctors' => $userDoctors]);
    }
}
