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

            $properties = json_decode($activity->properties, true);

            $formattedProperties = '<strong>New Attributes</strong><br>';
            if (isset($properties['attributes'])) {
                foreach ($properties['attributes'] as $key => $value) {
                    $formattedProperties .= ucfirst($key) . ': ' . htmlspecialchars($value) . '<br>';
                }
            }
            
            $formattedProperties .= '<br><strong>Old Attributes:</strong><br>';
            if (isset($properties['old'])) {
                foreach ($properties['old'] as $key => $value) {
                    $formattedProperties .= ucfirst($key) . ': ' . htmlspecialchars($value) . '<br>';
                }
            }
            
            $activity->formatted_properties = $formattedProperties;
        }

        return view('admin.audit_trail', ['activityLogs' => $activityLogs]);
    }
}
