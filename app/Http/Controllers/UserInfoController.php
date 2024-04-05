<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PatientRecord;
use App\Models\Patient;
use App\Models\Obgyne;
use App\Models\Booking;

class UserInfoController extends Controller
{
    public function user_info() {
        return view('user.user_info');
    }


    public function get_appointment() {
        $user = Auth::user();

    if ($user) {
        $booking = $user->booking()->get();
        
        return view('user.user_appointment', ['booking' => $booking]);
    } else {
        return redirect()->route('welcome');
    }
    }

    public function get_patientRecord() {
        $user = Auth::user();


        if ($user) {
            $patient = Patient::where('user_id', $user->id)->first();
            $pediatrics = PatientRecord::where('patient_id', '=' , $patient->id)->get();
            $obgyne = Obgyne::where('patient_id', '=' , $patient->id)->get();
            return view('user.user_patient_record', ['pediatrics' => $pediatrics]);
        } else {
            return redirect()->route('welcome');
        }
    }

    public function get_consultationRecord() {
        return view('user.user_consultation_history');
    }


    public function cancel_myBooking(Booking $book, Request $request) {
        $status = $request->input("status");
        $book->update([
            'status' => $status
        ]);

        return redirect(route('myAppointment'));
    }
}
