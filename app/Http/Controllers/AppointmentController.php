<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;


class AppointmentController extends Controller
{
    public function appointments(){
        $patients = Patient::all();
        $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
        return view('admin.appointments', ['doctors' => $doctors], ['patients' => $patients]);
    }

    public function store_appointment(Request $request){
        try {
            $rules = [
                'doctor_id' => 'required|exists:users,id', 
                'patient_id' => 'required|exists:patients,id', 
                'time' => 'required',
                'date' => 'required',
            ];
    
            $messages = [
                'doctor_id.required' => 'Doctor ID is required.',
                'doctor_id.exists' => 'Selected doctor does not exist.',
                'patient_id.required' => 'Patient ID is required.',
                'patient_id.exists' => 'Selected patient does not exist.',
                'time.required' => 'Time is required.',
                'time.date_format' => 'Invalid time format. It should be in HH:MM format.',
                'date.required' => 'Date is required.',
                'date.date_format' => 'Invalid date format. It should be in YYYY-MM-DD format.',
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
    
            $appointment = new Appointment();
            $appointment->doctor_id = $request->input("doctor_id");
            $appointment->patient_id = $request->input("patient_id");
            $appointment->time = $request->input("time");
            $appointment->date = $request->input("date");
            $appointment->save();
    
            $patients = Patient::all();
            $doctors = User::with('doctor')->where('usertype', '=', 'doctor')->get();
    
            return view('admin.appointments', ['doctors' => $doctors, 'patients' => $patients]);
        } catch (\Exception $e) {
            return view('admin.appointments')->with('error', $e->getMessage());
        }
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
    //asdad/
}
