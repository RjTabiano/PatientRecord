<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity; 
class AuditController extends Controller
{
    public function audit()
    {
        $activityLogs = Activity::all();
      
        return view('admin.audit_trail', ['activityLogs' => $activityLogs]);
    }
}
