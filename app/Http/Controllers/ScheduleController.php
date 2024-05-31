<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Schedule;
use Carbon\Carbon;
use Spatie\ActivityLog\Models\Activity;

class ScheduleController extends Controller
{
    public function schedules(){
        $userDoctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.schedules', ['userDoctors' => $userDoctors]);
    }

    public function store_schedule(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
            'doctor_id' => 'required',
            'day' => 'required',
        ]);

        // Retrieve the input data
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $doctor_id = $request->input('doctor_id');
        $day = $request->input('day');
        
        $existingSchedule = Schedule::where('doctor_id', '=', $doctor_id)
            ->exists();

        if ($existingSchedule == true) {
            return redirect()->back()->with('error', 'A schedule with the same day, start time, and end time already exists for this doctor.');
        }

        // If no existing schedule is found, proceed to create the new schedule
        $newSchedule = new Schedule();
        $newSchedule->doctor_id = $doctor_id;
        $newSchedule->day = $day;
        $newSchedule->start_time = $start_time;
        $newSchedule->end_time = $end_time;
        $newSchedule->save();

        // Redirect back to the schedules page with success message
        $userDoctors = User::with('doctor')->where('usertype', 'doctor')->get();
        return redirect()->route('schedule.schedule')->with('success', 'Schedule created successfully.')->with('userDoctors', $userDoctors);
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
