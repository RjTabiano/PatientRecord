<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MedicalHistory extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'medical_history';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Hypertension',
        'Asthma',
        'Thyroid_Disease',
        'Allergy',
        'social_history',
        'Family_History',
    ];
    
    protected $casts = [
        'social_history' => 'array',
        'Family_History' => 'array'
    ];
    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
    
}
