<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException; 

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

    public function store_booking(Request $request)
    {
        try {
            $booking = new Booking();
            $default_status = "Unconfirmed";
            $booking->user_id = $request->user()->id;
            $booking->service = $request->input("service");
            $booking->date = $request->input("date");
            $booking->time= $request->input("time");
            $booking->status = $default_status;
            $booking->save();
            
            Session::flash('success', 'Booking has been successfully created!');
        
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
