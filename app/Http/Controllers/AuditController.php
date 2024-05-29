<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity; 
class AuditController extends Controller
{
    public function audit()
    {
        $activityLogs = Activity::all();
        
        foreach ($activityLogs as $activity) {
            $user = User::find($activity->causer_id);
            $activity->causer_name = $user ? $user->name : 'Unknown';
        }

        return view('admin.audit_trail', ['activityLogs' => $activityLogs]);
    }
}
