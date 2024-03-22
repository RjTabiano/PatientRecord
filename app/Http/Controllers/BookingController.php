<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException; 
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function services(){
        return view('user.booking');
    }

    public function book_consultation(){
        return view('user.book_consultation');
    }

    public function book_pediatrics(){
        return view('user.book_pediatrics');
    }

    public function book_obgyne(){
        return view('user.book_obgyne');
    }

    /*public function store_booking(Request $request)
    {
        try {
            
            
            Session::flash('success', 'Booking has been successfully created!');
        
            return redirect()->route('welcome')->with('success', 'Booking has been successfully created! Please wait for a confirmation in your number or email.');
            
        } catch (QueryException $e) {
            Session::flash('error', 'An error occurred while saving the booking. Please try again later.');
        }
        
        return view('welcome');
    }*/

    public function store_booking(Request $request)
{
    $rules = [
        'date' => 'required|date',
        'time' => 'required',
    ];

    $validatedData = $request->validate($rules);
    $selectedTime =
    $allSchedules = Schedule::all();
    
    $isWithinDoctorSchedule = false;
    foreach ($allSchedules as $schedule) {
        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);
        $selectedTime = Carbon::parse($request->input("time"));
        
        if ($selectedTime->between($startTime, $endTime)) {
            $isWithinDoctorSchedule = true;
            break;
        }
    }

    if (!$isWithinDoctorSchedule) {
        return back()->withErrors(['error' => 'Selected time is not within any doctor\'s schedule.'])->withInput();
    }

    try {
        $booking = new Booking();
        $default_status = "Unconfirmed";
        $booking->user_id = $request->user()->id;
        $booking->service = $request->input("service");
        $booking->date = $request->input("date");
        $booking->time= $request->input("time");
        $booking->phone_number= $request->input("phone_number");
        $booking->status = $default_status;
        $booking->save();
        
        return redirect()->route('welcome')->with('success', 'Booking has been successfully created! Please wait for a confirmation in your number or email.');
    } catch (QueryException $e) {
        Session::flash('error', 'An error occurred while saving the booking. Please try again later.');
    }
    
    return view('welcome');
}

    public function view_booking()
    {
        $booking = User::with('booking')->get();
        return view('admin.booking', ['booking' => $booking]);
    }


    public function confirm_booking(Booking $booking, Request $request)
    {
        $status = $request->input("status");
        $booking->update([
            'status' => $status
        ]);


        if ($booking->wasChanged('status')) {
            $user =  User::where('id', '=' , $booking->user_id)->get();
            if ($user && $user[0]->name) {
                $apiKey = '57ef71187831988aaf4733eaec787fa2'; 
                $number = '0' . $booking->phone_number; 
                if ($status == 'Confirmed') {
                    $message = 'Hi ' . $user[0]->name . ', this is to inform you that your booking for an appointment on ' . $booking->date . ' - ' . $booking->time . " at The Queen's Clinic has been confirmed. See you soon and please stay safe!";
                } elseif ($status == 'Cancelled') {
                    $message = 'Your booking has been cancelled. We apologize for any inconvenience caused.';
                } else {
                    $message = 'Your booking status has been updated.';
                }

                $response = Http::post('https://api.semaphore.co/api/v4/messages', [
                    'apikey' => $apiKey,
                    'number' => $number,
                    'message' => $message,
                ]);
    
                if ($response->successful()) {
                    \Log::info('Message sent successfully.');
                } else {
                    \Log::error('Failed to send message: ' . $response->status());
                }
            } else {
                \Log::error('User or user\'s name not found.');
            }
        }
        
        return redirect(route('viewBooking'));
    }

    public function search_booking(Request $request){
        $search = $request->input('search');
        $booking = User::whereHas('booking')
        ->where('name', 'like', "%$search%")
        ->with('booking')
        ->get();

        return view('admin.booking', ['booking' => $booking]);
    }
}
