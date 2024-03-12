<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserApiController extends Controller
{
    public function index(){
        $users = User::all();

        return response()->json([
            'status' => 200,
            'users'  => $users
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user){
                return response()->json([
                    'status' => 200,
                    'message' => "User registered successfully"
                ], 200);
            }else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ], 500);
            }
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }


    public function show($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'status' => 200,
                'user' => $user
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No user found"
            ], 404);
        }
    }

    public function getLoggedInUser(Request $request)
    {
        if ($request->user()) {
            $user = $request->user();
            return response()->json([
                'name' => $user->name,
                'email' => $user->email
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function booking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'services' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i', // Assuming time format is HH:MM
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $user = Auth::user(); 

        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $booking = $user->bookings()->create([
            'services' => $request->services,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        if ($booking) {
            return response()->json([
                'status' => 200,
                'message' => 'Booking created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }


    public function getSchedules()
    {
        $schedules = Schedule::all();

        if ($schedules->isEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'Schedule is empty'
            ], 200);
        }

        return response()->json([
            'status' => 200,
            'schedules' => $schedules
        ], 200);
    }
    
}
