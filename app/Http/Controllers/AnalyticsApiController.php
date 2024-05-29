<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AnalyticsApiController extends Controller
{
    public function report() {
        return view('admin.analytics_report');
    }

    
    public function getBookingData()
    {
        $bookingData = DB::table('booking')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        return response()->json($bookingData);
    }


    public function getPatientData()
    {
        $patientData = [
            'pediatrics' => DB::table('pediatrics')->count(),
            'obgyne' => DB::table('obgyne')->count()
        ];

        $response = [
            ['service_type' => 'pediatrics', 'total' => $patientData['pediatrics']],
            ['service_type' => 'obgyne', 'total' => $patientData['obgyne']]
        ];

        return response()->json($response);
    }
}
