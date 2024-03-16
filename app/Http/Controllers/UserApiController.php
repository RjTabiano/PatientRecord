<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Image;
use App\Models\PatientRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


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
        try{
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
                        'message' => "User registered successfully",
                        'token' => $user->createToken("token")->plainTextToken
                    ], 200);
                }else {
                    return response()->json([
                        'status' => 500,
                        'message' => "Something went wrong"
                    ], 500);
                    }
                }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try{
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

        
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
            
            $user = User::where('email', $request->email)->first();
            
        
            /*
            $token = $user->createToken("token")->plainTextToken;
            return response()
                ->json(['user' => $user])
                ->header('Authorization', 'Bearer ' . $token);*/
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("token")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
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

    public function getLoggedInUser()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $name = $user->name;
        $email = $user->email;

        return response()->json([
            'name' => $name,
            'email' => $email
        ]);
    }

    public function booking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service' => 'required|string',
            'date' => 'required|string',
            'time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $user = auth()->user(); 

        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $booking = $user->booking()->create([
            'user_id' => $user->id,
            'service' => $request->service,
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

    public function getBooking()
{
    $user = auth()->user();

    if (!$user) {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized'
        ], 401);
    }

    $bookings = $user->booking()->get();

    $filteredBookings = $bookings->map(function ($booking) {
        return [
            'service' => $booking->service,
            'date' => $booking->date,
            'time' => $booking->time,
        ];
    });

    return $filteredBookings;
}



    public function storeImage(Request $request)
    {
        
       
        try {
            $base64ImageData = $request->input('imageData');
            $patientId = $request->input('patientId');
            $base64ImageData = substr($base64ImageData, strpos($base64ImageData, ',') + 1);
            Log::info('Patient ID' . $patientId);
            $image = new Image();
            $image->data = $base64ImageData;
            $patientRecord = PatientRecord::find($patientId);
            $userId = $patientRecord->patient->user_id;
            Log::info('Image data stored successfully. User ID: ' . $userId);
            $image->user_id = $userId;
            $image->save();

            return response()->json(['message' => 'Image data stored successfully'], 200);
        } catch (Exception $e) {
            logger()->error('Error storing image data: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to store image data'], 500);
        }
    }


    public function getUserImage()
{
    try {
        $user = Auth::user(); 
        $image = Image::where('user_id', $user->id)->first();

        if (!$image) {
            return response()->json(['error' => 'Image not found for the logged-in user'], 404);
        }

        return response()->json(['imageData' => $image->data], 200);
    } catch (\Exception $e) {
        logger()->error('Error retrieving user image: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to retrieve user image'], 500);
    }
}



}
