<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Patient;
use App\Models\Appointment;


class AppointmentController extends Controller
{
    public function appointments(){
        $patients = Patient::all();
        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.appointments', ['doctors' => $doctors], ['patients' => $patients]);
    }

    public function store_appointment(Request $request){
        $appointment = new Appointment();
        $appointment->doctor_id = $request->input("doctor_id");
        $appointment->patient_id = $request->input("patient_id");
        $appointment->time = $request->input("time");
        $appointment->date= $request->input("date");
        $appointment->save();
        
        $patients = Patient::all();
        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.appointments', ['doctors' => $doctors], ['patients' => $patients]);
    }

    public function delete_appointment(Appointment $appointment){
        $appointment->delete();
        return redirect(route('appointment.appointment'));
    }

    public function edit_appointment(Appointment $appointment){
        $patients = Patient::all();
        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.edit_appointment', compact('appointment', 'patients', 'doctors'));
    }

    public function update_appointment(Appointment $appointment, Request $request){
        $appointment->doctor_id = $request->input("doctor_id");
        $appointment->patient_id = $request->input("patient_id");
        $appointment->time = $request->input("time");
        $appointment->date= $request->input("date");
        $appointment->update();
        
        $patients = Patient::all();
        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.appointments', ['doctors' => $doctors], ['patients' => $patients]);
    }
    
}
